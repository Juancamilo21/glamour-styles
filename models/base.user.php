<?php

    class BaseUser {

        private $idUser;
        private $roleId;
        private $names;
        private $lastnames;
        private $address;
        private $phoneNumber;
        private $dci;
        private $email;
        private $password;
        private $photoPath;

        public function getIdUser() {
            return $this->idUser;
        }

        public function setRoleId($roleId) {
            $this->roleId = $roleId;
        }

        public function getRoleId() {
            return $this->roleId;
        }

        public function setNames($names) {
            $this->names = $names;
        }

        public function getNames() {
            return $this->names;
        }

        public function setLastnames($lastnames) {
            $this->lastnames = $lastnames;
        }

        public function getLastnames()
              {
            return $this->lastnames;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setPhoneNumber($phoneNumber) {
            $this->phoneNumber = $phoneNumber;
        }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function setDci($dci) {
            $this->dci = $dci;
        }

        public function getDci() {
            return $this->dci;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPhotoPath($photoPath) {
            $this->photoPath = $photoPath;
        }

        public function getPhotoPath() {
            return $this->photoPath;
        }
    }
