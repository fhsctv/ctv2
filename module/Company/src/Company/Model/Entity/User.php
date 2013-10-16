<?php


namespace Company\Model\Entity;

class User implements \Company\Model\IEntity {

    const TRUE  = 1;
    const FALSE = 0;

    protected $id;
    protected $username;
    protected $email;
    protected $displayName;
    protected $password;
    protected $state;

    public function getId() {
        return $this->id;
    }

    /**
     *
     * @param integer $id Benutzer- Id
     * @return \Company\Model\Entity\User
     */
    public function setId($id) {

        assert(is_numeric($id));

        $this->id = (int) $id;
        return $this;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getState() {
        return $this->state;
    }

    /**
     *
     * @param mixed $state nur die Werte 0 und 1 sind erlaubt
     * @return \Company\Model\Entity\User
     */
    public function setState($state) {

        assert(in_array($state, array(self::TRUE, self::FALSE)));

        $this->state = (int) $state;
        return $this;
    }

}

?>
