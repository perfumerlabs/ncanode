<?php

namespace Ncanode\Domain;

use Ncanode\Model\Signature;
use Ncanode\Model\TagQuery;
use Propel\Runtime\Collection\Collection;

class SignatureDomain
{
    public function create(?Signature $obj, array $data): ?Signature
    {
        $document = $data['document'] ?? null;
        $thread = $data['thread'] ?? null;
        $cms = $data['cms'] ?? null;
        $tags = $data['tags'] ?? [];
        $version_comment = $data['version_comment'] ?? null;
        $version_created_by = $data['version_created_by'] ?? null;

        if (!$document || !$thread || !$cms) {
            return null;
        }

        $tag_objs = new Collection();

        foreach ($tags as $tag) {
            $tag_obj = TagQuery::create()
                ->filterByCode($tag)
                ->findOneOrCreate();

            $tag_obj->save();

            $tag_objs->push($tag_obj);
        }

        if (!$obj) {
            $obj = new Signature();
        }

        $obj->setDocument($document);
        $obj->setThread($thread);
        $obj->setCms($cms);
        $obj->setTags($tag_objs);
        $obj->setVersionComment($version_comment);
        $obj->setVersionCreatedAt(new \DateTime());
        $obj->setVersionCreatedBy($version_created_by);
        $obj->save();

        return $obj;
    }

    public function delete(Signature $signature)
    {
        $signature->delete();
    }
}