<?php

namespace App\Repositories;

use App\Models\Domain;

class DomainRepository
{
    public function findById($id)
    {
        return Domain::where('id', $id)->first();
    }

    public function findByDomain($domain, $user_id)
    {
        return Domain::where('domain', $domain)
            ->where('user_id', $user_id)->first();
    }

    public function allByUser($user_id)
    {
        return Domain::where('user_id', $user_id)
            ->priority()
            ->get();
    }

    public function create($data)
    {
        return Domain::create($data);
    }

    public function update($data, Domain $domain)
    {
        return $domain->update($data);
    }

    public function delete($id)
    {
        return Domain::destroy($id);
    }

    public function filter($data, $user_id)
    {
        $query = Domain::query()
            ->priority()
            ->where('user_id', $user_id);

        if (isset($data['role'])) {
            $query->where('is_blocked', $data['role']);
        }

        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }

        return $query;
    }
}
