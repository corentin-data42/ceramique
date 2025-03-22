<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity('email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?string $nom = null;   

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank()]
    #[Assert\Email()]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\PasswordStrength([
        'minScore' => Assert\PasswordStrength::STRENGTH_MEDIUM, // Very strong password required
    ])]
    private ?string $password = null;

    #[ORM\Column]
    #[Assert\Type('boolean')]
    private bool $flagEtat = false;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $creationAt = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $modificationAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of flagEtat
     */ 
    public function getFlagEtat()
    {
        return $this->flagEtat;
    }

    /**
     * Set the value of flagEtat
     *
     * @return  self
     */ 
    public function setFlagEtat(bool $flagEtat)
    {
        $this->flagEtat = $flagEtat;

        return $this;
    }

    /**
     * Get the value of creationAt
     */ 
    public function getCreationAt(): \DateTimeImmutable|null
    {
        return $this->creationAt;
    }

    /**
     * Set the value of creationAt
     *
     * @return  self
     */ 
    public function setCreationAt(\DateTimeImmutable $creationAt)
    {
        $this->creationAt = $creationAt;

        return $this;
    }

    /**
     * Get the value of modificationAt
     */ 
    public function getModificationAt(): \DateTimeImmutable|null
    {
        return $this->modificationAt;
    }

    /**
     * Set the value of modificationAt
     *
     * @return  self
     */ 
    public function setModificationAt( \DateTimeImmutable $modificationAt)
    {
        $this->modificationAt = $modificationAt;

        return $this;
    }
}
