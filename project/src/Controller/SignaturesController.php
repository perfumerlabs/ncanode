<?php

namespace Ncanode\Controller;

use Ncanode\Model\SignatureQuery;
use Ncanode\Repository\SignatureRepository;
use Propel\Runtime\ActiveQuery\Criteria;

class SignaturesController extends LayoutController
{
    public function get()
    {
        $document = $this->f('document');
        $chain = $this->f('chain');
        $stage = $this->f('stage');
        $tags   = $this->f('tags');
        $limit  = (int) $this->f('limit');
        $offset = (int) $this->f('offset');
        $count  = (bool) $this->f('count');

        $objs = SignatureQuery::create()
            ->leftJoinSignatureTag()
            ->useSignatureTagQuery()
            ->leftJoinTag()
            ->endUse()
            ->orderByCreatedAt(Criteria::DESC);

        if ($document) {
            $objs = $objs->filterByDocument($document);
        }

        if ($chain) {
            $objs = $objs->filterByChain($chain);
        }

        if ($stage) {
            $objs = $objs->filterByStage($stage);
        }

        if ($tags) {
            if (!is_array($tags)) {
                $tags = [$tags];
            }

            $objs = $objs
                ->useSignatureTagQuery()
                ->useTagQuery()
                ->filterByCode($tags)
                ->endUse()
                ->endUse();
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
