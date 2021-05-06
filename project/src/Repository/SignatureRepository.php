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

        foreach ($obj->getTags() as $tag) {
            $tags[] = $tag->getCode();
        }

        return [
            'id' => $obj->getId(),
            'document' => $obj->getDocument(),
            'thread' => $obj->getThread(),
            'version' => $obj->getVersion(),
            'version_comment' => $obj->getVersionComment(),
            'version_created_at' => $obj->getVersionCreatedAt('Y-m-d H:i:s'),
            'version_created_by' => $obj->getVersionCreatedBy(),
            'cms' => $obj->getCms(),
            'tags' => $tags,
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