<?php

namespace Ncanode\Controller;

use Ncanode\Model\SignatureQuery;
use Ncanode\Repository\SignatureRepository;
use Propel\Runtime\ActiveQuery\Criteria;

class SignaturesController extends LayoutController
{
    public function get()
    {
        $parent = $this->f('parent');
        $tags   = $this->f('tags');
        $limit  = (int) $this->f('limit');
        $offset = (int) $this->f('offset');
        $count  = (bool) $this->f('count');

        $objs = SignatureQuery::create()
            ->orderByCreatedAt(Criteria::DESC);

        if ($parent) {
            $parent_obj = null;

            if (is_int($parent)) {
                $parent_obj = SignatureQuery::create()
                    ->findPk($parent);
            } elseif (is_string($parent)) {
                $parent_obj = SignatureQuery::create()
                    ->findOneByCode($parent);
            }

            $objs = $objs
                ->filterByParent($parent_obj);
        }

        if ($tags) {
            if (!is_array($tags)) {
                $tags = [$tags];
            }

            $objs = $objs
                ->filterByTags($tags, Criteria::CONTAINS_SOME);
        }

        if ($count) {
            $nb_results_query = clone $objs;
            $nb_results       = $nb_results_query->count();
        }

        if ($limit) {
            $objs->limit($limit);
        }

        if ($offset) {
            $objs->offset($offset);
        }

        $objs = $objs->find();

        /** @var SignatureRepository $repository */
        $repository = $this->s('ncanode.repository.signature');

        $content = [
            'signatures' => $repository->formatCollection($objs),
        ];

        if ($count) {
            $content['nb_results'] = (int) $nb_results;
        }

        $this->setContent($content);
    }
}
