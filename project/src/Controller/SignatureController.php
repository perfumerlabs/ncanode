<?php

namespace Ncanode\Controller;

use Ncanode\Domain\SignatureDomain;
use Ncanode\Domain\TagDomain;
use Ncanode\Model\Map\SignatureTableMap;
use Ncanode\Model\SignatureQuery;
use Ncanode\Repository\SignatureRepository;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;

class SignatureController extends LayoutController
{
    public function get()
    {
        $id       = (int) $this->f('id');
        $parent   = (int) $this->f('parent');
        $document = $this->f('document');
        $chain    = $this->f('chain');
        $stage    = $this->f('stage');

        if (!$id && !$parent && !$document) {
            $this->forward(
                'error',
                'badRequest',
                ['ID, parent, document. ' . $this->t('error.one_of_parameters_must_be_set')]
            );
        }

        $obj = SignatureQuery::create()
            ->leftJoinSignatureTag()
            ->useSignatureTagQuery()
            ->leftJoinTag()
            ->endUse();

        if ($document) {
            $obj = $obj
                ->filterByDocument($document)
                ->_if($chain)
                ->filterByChain($chain)
                ->_endif()
                ->_if($stage)
                ->filterByStage($stage)
                ->_endif()
                ->orderByCreatedAt(Criteria::DESC);
        }

        if ($parent) {
            $obj = $obj
                ->filterByParentId($parent);
        }

        if ($id) {
            $obj = $obj
                ->filterById($id);
        }

        $obj = $obj->findOne();

        if (!$obj) {
            $this->forward('error', 'badRequest', [$this->t('error.signature_not_found')]);
        }

        /** @var SignatureRepository $repository */
        $repository = $this->s('ncanode.repository.signature');

        $this->setContent(['signature' => $repository->format($obj)]);
    }

    public function post()
    {
        $document  = $this->f('document');
        $chain     = $this->f('chain');
        $stage     = $this->f('stage');
        $parent    = (int) $this->f('parent');
        $signature = $this->f('signature');
        $tags      = $this->f('tags');

        $this->validateNotEmpty($document, 'document');
        $this->validateNotEmpty($signature, 'signature');

        $exist_obj = SignatureQuery::create()
            ->filterByDocument($document)
            ->_if($chain)
            ->filterByChain($chain)
            ->_endif()
            ->_if($stage)
            ->filterByStage($stage)
            ->_endif()
            ->exists();

        if ($exist_obj) {
            $this->forward('error', 'badRequest', [$this->t('error.same_signature_exists')]);
        }

        $parent_obj = null;

        if ($parent) {
            $parent_obj = SignatureQuery::create()
                ->findPk($parent);

            if (!$parent_obj) {
                $this->forward('error', 'badRequest', [$this->t('error.signature_code_exists')]);
            }
        }

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        /** @var TagDomain $tag_domain */
        $tag_domain = $this->s('ncanode.domain.tag');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $obj = $domain->save(
                [
                    'document'  => $document,
                    'chain'     => $chain,
                    'stage'     => $stage,
                    'parent'    => $parent_obj,
                    'signature' => $signature,
                ]
            );

            if ($obj && $tags) {
                if (!is_array($tags)) {
                    $tags = [$tags];
                }

                foreach ($tags as $tag) {
                    if (!is_string($tag)) {
                        continue;
                    }

                    $tag_obj = $tag_domain->save(['code' => $tag]);
                    if ($tag_obj) {
                        $domain->addTag($obj, $tag_obj);
                    }
                }
            }

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();
        }
    }

    public function delete()
    {
        $id = (int) $this->f('id');

        $this->validateNotEmpty($id, 'id');

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $domain->delete($id);

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();
        }
    }
}
