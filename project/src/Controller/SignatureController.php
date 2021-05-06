<?php

namespace Ncanode\Controller;

use Ncanode\Domain\SignatureDomain;
use Ncanode\Model\Map\SignatureTableMap;
use Ncanode\Model\SignatureQuery;
use Ncanode\Repository\SignatureRepository;
use Perfumer\Helper\Arr;
use Propel\Runtime\Propel;

class SignatureController extends LayoutController
{
    public function get()
    {
        $document = $this->f('document');
        $thread = $this->f('thread');

        if (!$thread && !$document) {
            $this->forward(
                'error',
                'badRequest',
                ['"Thread" and "document" parameters must be set']
            );
        }

        $obj = SignatureQuery::create()
            ->filterByDocument($document)
            ->filterByThread($thread)
            ->findOne();

        if (!$obj) {
            $this->forward('error', 'pageNotFound', [$this->t('error.signature_not_found')]);
        }

        /** @var SignatureRepository $repository */
        $repository = $this->s('ncanode.repository.signature');

        $this->setContent(['signature' => $repository->format($obj)]);
    }

    public function post()
    {
        $document = (string) $this->f('document');
        $thread = (string) $this->f('thread');
        $cms = (string) $this->f('cms');
        $version = (int) $this->f('version');

        $this->validateNotEmpty($document, 'document');
        $this->validateNotEmpty($thread, 'thread');
        $this->validateNotEmpty($cms, 'cms');

        $obj = SignatureQuery::create()
            ->filterByDocument($document)
            ->filterByThread($thread)
            ->findOne();

        if ($obj && !$version) {
            $this->forward(
                'error',
                'badRequest',
                ['Version must be set']
            );
        }

        if ($obj && $obj->getVersion() !== $version) {
            $this->forward(
                'error',
                'badRequest',
                ['Version provided is not equal to actual signature version']
            );
        }

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $obj = $domain->create($obj, Arr::fetch($this->f(), [
                'document',
                'thread',
                'cms',
                'version_comment',
                'version_created_by',
                'tags',
            ]));

            /** @var SignatureRepository $repository */
            $repository = $this->s('ncanode.repository.signature');

            $this->setContent(['signature' => $repository->format($obj)]);

            $this->getExternalResponse()->setStatusCode(201);

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();

            throw $e;
        }
    }

    public function delete()
    {
        $document = $this->f('document');
        $thread = $this->f('thread');

        if (!$thread && !$document) {
            $this->forward(
                'error',
                'badRequest',
                ['"Thread" and "document" parameters must be set']
            );
        }

        $obj = SignatureQuery::create()
            ->filterByDocument($document)
            ->filterByThread($thread)
            ->findOne();

        if (!$obj) {
            $this->forward('error', 'pageNotFound', [$this->t('error.signature_not_found')]);
        }

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $domain->delete($obj);

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();

            throw $e;
        }
    }
}
