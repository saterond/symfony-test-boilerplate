<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements UserInterface, \Serializable
{

	/**
	 * @var int
	 * @ORM\Column(type="integer", name="user_id")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	protected $email;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	protected $password;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=false, name="datetime_created")
	 */
	protected $datetimeCreated;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=true, name="datetime_updated")
	 */
	protected $datetimeUpdated;

	/**
	 * @var bool
	 * @ORM\Column(type="boolean")
	 */
	protected $active = true;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=25)
	 */
	protected $role = "ROLE_USER";

	/**
	 * String representation of object
	 * @link http://php.net/manual/en/serializable.serialize.php
	 * @return string the string representation of the object or null
	 * @since 5.1.0
	 */
	public function serialize()
	{
		return serialize([
			$this->id,
			$this->email,
			$this->password,
			$this->active,
			$this->role
		]);
	}

	/**
	 * Constructs the object
	 * @link http://php.net/manual/en/serializable.unserialize.php
	 * @param string $serialized <p>
	 * The string representation of the object.
	 * </p>
	 * @return void
	 * @since 5.1.0
	 */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->email,
			$this->password,
			$this->active,
			$this->role,
			) = unserialize($serialized);
	}

	/**
	 * Returns the roles granted to the user.
	 *
	 * <code>
	 * public function getRoles()
	 * {
	 *     return array('ROLE_USER');
	 * }
	 * </code>
	 *
	 * Alternatively, the roles might be stored on a ``roles`` property,
	 * and populated in any number of different ways when the user object
	 * is created.
	 *
	 * @return (Role|string)[] The user roles
	 */
	public function getRoles()
	{
		return [$this->role];
	}

	/**
	 * Returns the password used to authenticate the user.
	 *
	 * This should be the encoded password. On authentication, a plain-text
	 * password will be salted, encoded, and then compared to this value.
	 *
	 * @return string The password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Returns the salt that was originally used to encode the password.
	 *
	 * This can return null if the password was not encoded using a salt.
	 *
	 * @return string|null The salt
	 */
	public function getSalt()
	{
		return null;
	}

	/**
	 * Returns the username used to authenticate the user.
	 *
	 * @return string The username
	 */
	public function getUsername()
	{
		return $this->email;
	}

	/**
	 * Removes sensitive data from the user.
	 *
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 */
	public function eraseCredentials()
	{
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return self
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return self
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDatetimeCreated()
	{
		return $this->datetimeCreated;
	}

	/**
	 * @param \DateTime $datetimeCreated
	 * @return self
	 */
	public function setDatetimeCreated($datetimeCreated)
	{
		$this->datetimeCreated = $datetimeCreated;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDatetimeUpdated()
	{
		return $this->datetimeUpdated;
	}

	/**
	 * @param \DateTime $datetimeUpdated
	 * @return self
	 */
	public function setDatetimeUpdated($datetimeUpdated)
	{
		$this->datetimeUpdated = $datetimeUpdated;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isActive()
	{
		return $this->active;
	}

	/**
	 * @param boolean $active
	 * @return self
	 */
	public function setActive($active)
	{
		$this->active = $active;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRole()
	{
		return $this->role;
	}

	/**
	 * @param string $role
	 * @return self
	 */
	public function setRole($role)
	{
		$this->role = $role;
		return $this;
	}

	/**
	 * @param string $password
	 * @return self
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}
}
