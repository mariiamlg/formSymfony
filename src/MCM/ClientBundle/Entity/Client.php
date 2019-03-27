<?php

namespace MCM\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Client
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="id_card", type="string", length=255)
     */
    private $idCard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="subscribed", type="boolean")
     */
    private $subscribed;

    /**
     * @var string
     *
     * @ORM\Column(name="type_cachtment", type="string", length=255)
     */
    private $typeCachtment;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip_code", type="integer")
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", length=255)
     */
    private $comments;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Client
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set idCard
     *
     * @param string $idCard
     *
     * @return Client
     */
    public function setIdCard($idCard)
    {
        $this->idCard = $idCard;

        return $this;
    }

    /**
     * Get idCard
     *
     * @return string
     */
    public function getIdCard()
    {
        return $this->idCard;
    }

    /**
     * Set subscribed
     *
     * @param boolean $subscribed
     *
     * @return Client
     */
    public function setSubscribed($subscribed)
    {
        $this->subscribed = $subscribed;

        return $this;
    }

    /**
     * Get subscribed
     *
     * @return boolean
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * Set typeCachtment
     *
     * @param string $typeCachtment
     *
     * @return Client
     */
    public function setTypeCachtment($typeCachtment)
    {
        $this->typeCachtment = $typeCachtment;

        return $this;
    }

    /**
     * Get typeCachtment
     *
     * @return string
     */
    public function getTypeCachtment()
    {
        return $this->typeCachtment;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Client
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     *
     * @return Client
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return integer
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Client
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Client
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Client
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Client
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
}

