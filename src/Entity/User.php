<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $lastname;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $waiEnabled = false;


    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string {
        return (string)$this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string {
        return (string)$this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt() {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials() {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    /**
     * @return string
     */
    public function getEmail(): string {
        return (string)$this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }


    /**
     * @return bool
     */
    public function getWaiEnabled(): bool {
        return (boolean)$this->waiEnabled;
    }

    /**
     * @param bool $waiEnabled
     * @return $this
     */
    public function setWaiEnabled(bool $waiEnabled): self {
        $this->waiEnabled = $waiEnabled;

        return $this;
    }


    /**
     * @return string
     */
    public function getFirstname(): string {
        return $this->firstname;
    }


    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname(string $firstname): self {
        $this->firstname = $firstname;
        return $this;
    }


    /**
     * @return string
     */
    public function getLastname(): string {
        return $this->lastname;
    }


    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname(string $lastname): self {
        $this->lastname = $lastname;
        return $this;
    }

}
