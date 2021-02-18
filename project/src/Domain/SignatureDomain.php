<?php

namespace Ncanode\Domain;

use Ncanode\Model\Signature;
use Ncanode\Model\SignatureQuery;

class SignatureDomain
{
    public function save(array $data): ?Signature
    {
        $id = $data['id'] ?? null;

        $obj = null;

        if ($id) {
            $obj = SignatureQuery::create()
                ->findPk($id);
        }

        if (!$obj) {
            $obj = new Signature();
        }

        if (array_key_exists('code', $data)) {
            $obj->setCode($data['code']);
        }

        if (array_key_exists('parent', $data)) {
            $parent = null;

            if (is_int($data['parent'])) {
                $parent = SignatureQuery::create()
                    ->findPk($data['parent']);
            } elseif (is_string($data['parent'])) {
                $parent = SignatureQuery::create()
                    ->findOneByCode($data['parent']);
            } elseif ($data['parent'] instanceof Signature) {
                $parent = $data['parent'];
            }

            $obj->setParent($parent);
        }

        if (array_key_exists('signature', $data)) {
            $obj->setSignature($data['signature']);
        }

        if (array_key_exists('tags', $data)) {
            $tags = null;
            if ($data['tags'] !== null && $data['tags'] !== '') {
                if (!is_array($data['tags'])) {
                    $tags = [$data['tags']];
                } else {
                    $tags = $data['tags'];
                }
            }

            $obj->setTags($tags);
        }

        $obj->save();

        return $obj;
    }

    public function delete(int $id)
    {
        $obj = SignatureQuery::create()
            ->findPk($id);

        if (!$obj) {
            return;
        }

        $obj->delete();
    }
}