<?php

namespace App\Concerns\SiteOptionsService;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait ContactInfo
{
    /**
     * Factorize
     *
     * @return Collection
     */
    protected function contact_info(): Collection
    {
        $contact = $this->get('contact_info', collect([
            'emails' => [
                'primary' => null,
                'contact' => null,
                'adsense' => null,
            ],
            'phones' => [
                'primary' => null,
                'contact' => null,
                'adsense' => null,
            ],
            'social' => [
                'github' => null,
                'youtube' => null,
                'twitter' => null,
                'linkedin' => null,
                'facebook' => null,
                'whatsapp' => null,
                'instagram' => null,
            ],
            'address' => null,
            'locations' => [],
        ]));

        return $contact;
    }

    /**
     * Get primary email
     *
     * @param  ?string $default
     * @return string
     */
    public function getPrimaryEmail(string $default = null)
    {
        return Arr::get(
            $this->contact_info()->toArray(),
            'emails.primary',
            $default
        );
    }

    /**
     * Get contact email
     *
     * @param  ?string $default
     * @return string
     */
    public function getContactEmail(string $default = null)
    {
        return Arr::get(
            $this->contact_info()->toArray(),
            'emails.contact',
            $default
        );
    }

    /**
     * Get primary phone
     *
     * @param  ?string $default
     * @return string
     */
    public function getPrimaryPhone(string $default = null)
    {
        return Arr::get(
            $this->contact_info()->toArray(),
            'phones.primary',
            $default
        );
    }

    /**
     * Get contact phone
     *
     * @param  ?string $default
     * @return string
     */
    public function getContactPhone(string $default = null)
    {
        return Arr::get(
            $this->contact_info()->toArray(),
            'phones.contact',
            $default
        );
    }

    /**
     * Get social link
     *
     * @param string   $platform
     * @param  ?string $default
     * @return string
     */
    public function getSocialLink(string $platform, string $default = null)
    {
        $platform = str($platform)->trim()->lower();
        return Arr::get(
            $this->contact_info()->toArray(),
            "social.{$platform}",
            $default
        );
    }

    /**
     * Get location
     *
     * @param string $location
     * @param mixed  $default
     * @return mixed
     */
    public function getLocation(string $location, $default = null)
    {
        return Arr::get(
            $this->contact_info()->toArray(),
            "locations.{$location}",
            $default
        );
    }

    /**
     * Get address
     *
     * @param  ?string $default
     * @return string
     */
    public function getAddress(string $default = null)
    {
        return Arr::get(
            $this->contact_info()->toArray(),
            'address',
            $default
        );
    }

    /**
     * Get Location Info
     *
     * @param  string      $key
     * @param  string|bool $separator
     * @return mixed
     */
    public function getLocationInfo(string $key, string|bool $seperator = false)
    {
        $locations = Arr::get($this->contact_info()->toArray(), 'locations', []);
        $location =  Arr::get($locations, $key);

        if (is_array($location)) {
            if (!$seperator || $location == 'array') {
                return $location;
            } else {
                return implode($seperator, $location);
            }
        }

        return $location;
    }
}
