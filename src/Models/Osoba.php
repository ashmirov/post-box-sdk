<?php

namespace Post\Box\Sdk\Models;

class Osoba
{
    /**
     * @var string
     */
    public string $Ico;

    /**
     * @var string
     */
    public string $NazevOsoby;

    /**
     * @var string
     */
    public string $ISDS;

    /**
     * @var bool
     */
    public bool $PDZ;

    /**
     * @var string
     */
    public string $TypSubjektu;

    /**
     * @var AdresaSidla
     */
    public AdresaSidla $AdresaSidla;
}