<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Brand = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $IMEI = null;

    #[ORM\Column(length: 255)]
    private ?string $SN = null;

    #[ORM\Column]
    private ?int $PN = null;

    #[ORM\Column(length: 255)]
    private ?string $googleAccount = null;

    #[ORM\Column(length: 255)]
    private ?string $Note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): static
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getIMEI(): ?string
    {
        return $this->IMEI;
    }

    public function setIMEI(string $IMEI): static
    {
        $this->IMEI = $IMEI;

        return $this;
    }

    public function getSN(): ?string
    {
        return $this->SN;
    }

    public function setSN(string $SN): static
    {
        $this->SN = $SN;

        return $this;
    }

    public function getPN(): ?int
    {
        return $this->PN;
    }

    public function setPN(int $PN): static
    {
        $this->PN = $PN;

        return $this;
    }

    public function getGoogleAccount(): ?string
    {
        return $this->googleAccount;
    }

    public function setGoogleAccount(string $googleAccount): static
    {
        $this->googleAccount = $googleAccount;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(string $Note): static
    {
        $this->Note = $Note;

        return $this;
    }
}
