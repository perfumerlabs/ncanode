<?php

namespace Ncanode\Domain;

use Ncanode\Model\Tag;
use Ncanode\Model\TagQuery;

class TagDomain
{
    public function save(array $data): ?Tag
    {
        $code = $data['code'] ?? null;

        if (!$code) {
            return null;
        }

        $obj = TagQuery::create()
            ->filterByCode($code)
            ->findOneOrCreate();

        $obj->save();

        return $obj;
    }

    public function delete(int $id)
    {
        $obj = TagQuery::create()
            ->findPk($id);

        if (!$obj) {
            return;
        }

        $obj->delete();
    }
}