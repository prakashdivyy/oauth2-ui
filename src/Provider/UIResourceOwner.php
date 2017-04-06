<?php

namespace PrakashDivy\OAuth2\Client\Provider;

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
     * Get user ID SIAK
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getResponseData('user_id');
    }

    /**
     * Get user Nama
     *
     * @return string|null
     */
    public function getNama()
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
     * Get user Kode Organisasi
     *
     * @return string|null
     */
    public function getKdOrg()
    {
        return $this->getResponseData('siak_kd_org');
    }

    /**
     * Get user ldap_dn
     *
     * @return string|null
     */
    public function getLdapDn()
    {
        return $this->getResponseData('ldap_dn');
    }

    /**
     * Get user ldap_sn
     *
     * @return string|null
     */
    public function getLdapSn()
    {
        return $this->getResponseData('ldap_sn');
    }

    /**
     * Get user is active or not
     *
     * @return string|null
     */
    public function isActiveUser()
    {
        return $this->getResponseData('siak_is_active');
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