<?php
class User{

    // attributes
    private $id = 0;
    private $username ="";
    private $full_name = "";
    private $password = "";
    private $email = "";

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
    function getEmail(): string{
        return $this->email;
    }

    // setter

    function setUsername(string $username){
        $this->username = $username;
    }
    function setPassword(string $password){
        $this->password = $password;
    }
    function setFullName(string $full_name){
        $this->full_name = $full_name;
    }
    function setEmail(string $email){
        $this->email = $email;
    }

    function verifyPassword(string $passwordToVerify){
        return password_verify($passwordToVerify, $this->getPassword());
    }

}
?>