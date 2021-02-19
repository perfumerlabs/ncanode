<?php

namespace Ncanode\Domain;

use Ncanode\Model\Signature;
use Ncanode\Model\SignatureQuery;
use Ncanode\Model\SignatureTagQuery;
use Ncanode\Model\Tag;
use Ncanode\Model\TagQuery;

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

        if (array_key_exists('document', $data)) {
            $obj->setDocument($data['document']);
        }

        if (array_key_exists('chain', $data)) {
            $obj->setChain($data['chain']);
        }

        if (array_key_exists('stage', $data)) {
            $obj->setStage($data['stage']);
        }

        if (array_key_exists('parent', $data)) {
            $parent = null;

            if (is_int($data['parent'])) {
                $parent = SignatureQuery::create()
                    ->findPk($data['parent']);
            } elseif ($data['parent'] instanceof Signature) {
                $parent = $data['parent'];
            }

            $obj->setParent($parent);
        }

        if (array_key_exists('signature', $data)) {
            $obj->setSignature($data['signature']);
        }

        $obj->save();

        return $obj;
    }

    public function addTag(Signature $obj, $tag)
    {
        $tag_obj = null;
        if (is_int($tag)) {
            $tag_obj = TagQuery::create()
                ->findPk($tag);
        } elseif (is_string($tag)) {
            $tag_obj = TagQuery::create()
                ->findOneByCode($tag);
        } elseif ($tag instanceof Tag) {
            $tag_obj = $tag;
        }

        if (!$tag_obj) {
            return;
        }

        SignatureTagQuery::create()
            ->filterBySignature($obj)
            ->filterByTag($tag_obj)
            ->findOneOrCreate()
            ->save();
    }

    public function deleteTag(Signature $obj, $tag)
    {
        $tag_obj = null;
        if (is_int($tag)) {
            $tag_obj = TagQuery::create()
                ->findPk($tag);
        } elseif (is_string($tag)) {
            $tag_obj = TagQuery::create()
                ->findOneByCode($tag);
        } elseif ($tag instanceof Tag) {
            $tag_obj = $tag;
        }

        if (!$tag_obj) {
            return;
        }

        SignatureTagQuery::create()
            ->filterBySignature($obj)
            ->filterByTag($tag_obj)
            ->delete();
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