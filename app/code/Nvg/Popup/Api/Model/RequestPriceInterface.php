<?php

namespace Nvg\Popup\Api\Model;

/**
 * Interface RequestPriceInterface
 * @package Nvg\Popup\Api\Model
 */
interface RequestPriceInterface
{
    const TABLE_NAME                = 'requests_for_prices';
    const ID_FIELD                  = 'id';
    const NAME                      = 'name';
    const EMAIL                     = 'email';
    const STATUS                    = 'status';
    const DATE                      = 'created';

    /**
     * @param $name
     * @return void
     */
    public function setName($name);

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email);

    /**
     * @param $status
     * @return void
     */
    public function setStatus($status);

    /**
     * @param $date
     * @return void
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return bool
     */
    public function getStatus(): bool;
}