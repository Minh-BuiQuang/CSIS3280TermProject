<?php
class User{

    // attributes
    private $id = 0;
    private $username ="";
    private $full_name = "";
    private $password = "";

    // getter
    function getId() : int{
        return $this->id;
    }
    function getUsername(): string{
        return $this->username;
    }
    function getFullName(): string {
        return $this->full_name;
    }
    function getPassword(): string{
        return $this->password;
    }

    // setter

    function verifyPassword(string $passwordToVerify){
        return password_verify($passwordToVerify, $this->getPassword());
    }

}
?>