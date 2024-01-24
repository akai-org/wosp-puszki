<?php

declare(strict_types=1);

namespace App\Virtual\Triat;

/**
 * @author kabix09
 *
 * Trial for time mark objects
 */
trait Timestampable
{
    /**
     * @OA\Property(
     *     title="Created At",
     *     description="Time of created record",
     *     format="datetime",
     *     type="string",
     *     example="2023-03-18 10:22:25.323"
     * )
     *
     * @var \DateTime
     */
    public $created_at;

    /**
     * @OA\Property(
     *     title="Updated At",
     *     description="Time of last record update",
     *     format="datetime",
     *     type="string",
     *     example="2023-03-18 10:22:25.323"
     * )
     *
     * @var \DateTime
     */
    public $updated_at;


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
