<?php

namespace App\Services;

use App\Exceptions\ExistDomainException;
use App\Models\Domain;
use App\Repositories\DomainRepository;
use PhpParser\Node\Expr\Throw_;

class DomainService
{
    private DomainRepository $domainRepository;

    public function __construct()
    {
        $this->domainRepository = new DomainRepository();
    }

    public function getById($id)
    {
        return $this->domainRepository->findById($id);
    }

    public function getDomainByDomain($domain, $user_id)
    {
        return $this->domainRepository->findByDomain($domain, $user_id);
    }


    public function createDomain($data)
    {
        $hasDomain = $this->getDomainByDomain($data['domain'], $data['user_id']);

        if ($hasDomain) {
            return throw new ExistDomainException();
        }

        return $this->domainRepository->create($data);
    }

    public function updateDomain($data, Domain $domain)
    {
        $hasDomain = false;

        if ($data['domain'] != $domain->domain) {
            $hasDomain = $this->getDomainByDomain($data['domain'], $data['user_id']);
        }

        if ($hasDomain) {
            return throw new ExistDomainException();
        }

        return $this->domainRepository->update($data, $domain);
    }

    public function deleteDomain($id)
    {
        return $this->domainRepository->delete($id);
    }

    public function filterDomains($data, $user_id)
    {

        return $this->domainRepository->filter($data, $user_id);
    }
}
