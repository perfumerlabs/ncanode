<?php

namespace Ncanode\Repository;

use Ncanode\Model\Signature;

class SignatureRepository
{
    public function format(?Signature $obj): ?array
    {
        if (!$obj) {
            return null;
        }

        $tags = [];

        foreach ($obj->getSignatureTags() as $signature_tag) {
            $tags[] = $signature_tag->getTag()->getCode();
        }

        return [
            'id'         => $obj->getId(),
            'document'   => $obj->getDocument(),
            'chain'      => $obj->getChain(),
            'stage'      => $obj->getStage(),
            'parent'     => $this->format($obj->getParent()),
            'signature'  => $obj->getSignature(),
            'tags'       => $tags,
            'created_at' => $obj->getCreatedAt('Y-m-d H:i:s'),
            'updated_at' => $obj->getUpdatedAt('Y-m-d H:i:s'),
        ];
    }

    /**
     * @param Signature[] $objs
     * @return array|null
     */
    public function formatCollection($objs): ?array
    {
        if (!$objs) {
            return null;
        }

        $result = [];

        foreach ($objs as $obj) {
            $result[] = $this->format($obj);
        }

        return $result;
    }
}