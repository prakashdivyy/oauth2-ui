<?php

namespace PrakashDivy\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
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
     * Raw additionalData
     *
     * @var array
     */
    protected $additionalData;

    /**
     * Creates new resource owner.
     *
     * @param array $response
     * @param AccessToken $token
     */
    public function __construct(array $response = array(), AccessToken $token)
    {
        $this->response = $response;
        $header = array();
        $header[] = 'Authorization: Bearer ' . $token . '-' . $_SERVER['REMOTE_ADDR'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sso.ui.ac.id/rest/api/web/v1/mahasiswa/info");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "kd_mhs=" . $this->getNPM());
        $response = curl_exec($ch);
        curl_close($ch);
        $this->additionalData = json_decode($response, true)['data'];
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
     * Get user picture
     *
     * @return string|null
     */
    public function getFoto()
    {
        return $this->getAdditionalData('foto');
    }

    /**
     * Get user angkatan
     *
     * @return string|null
     */
    public function getAngkatan()
    {
        return $this->getAdditionalData('angkatan');
    }

    /**
     * Get user fakultas
     *
     * @return string|null
     */
    public function getFakultas()
    {
        return $this->getAdditionalData('nm_fakultas');
    }

    /**
     * Get user prodi
     *
     * @return string|null
     */
    public function getProdi()
    {
        return $this->getAdditionalData('nm_prodi');
    }

    /**
     * Get user jenjang
     *
     * @return string|null
     */
    public function getJenjang()
    {
        return $this->getAdditionalData('jenjang');
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
     * Attempts to pull value from array using dot notation.
     *
     * @param string $path
     * @param string $default
     *
     * @return mixed
     */
    protected function getAdditionalData($path, $default = null)
    {
        return $this->getValueByKey($this->additionalData, $path, $default);
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