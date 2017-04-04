<?php

namespace Q5Studio\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class UIResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get user id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getResponseData('user_id');
    }

    /**
     * Get user name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getResponseData('siak_nama');
    }

    /**
     * Get user NPM
     *
     * @return string|null
     */
    public function getNPM()
    {
        return $this->getResponseData('siak_npm');
    }

    /**
     * Get user kode organisasi
     *
     * @return string|null
     */
    public function getKdOrg()
    {
        return $this->getResponseData('siak_kd_org');
    }

    /**
     * Attempts to pull value from array using dot notation.
     *
     * @param string $path
     * @param string $default
     *
     * @return mixed
     */
    protected function getResponseData($path, $default = null)
    {
        return $this->getValueByKey($this->response, $path, $default);
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}