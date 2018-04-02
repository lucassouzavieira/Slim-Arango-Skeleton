<?php

namespace App\Core\Collection;

use Slim\Container;
use ArangoDBClient\Document;
use ArangoDBClient\ServerException;
use ArangoDBClient\DocumentHandler;
use ArangoDBClient\CollectionHandler;
use ArangoDBClient\Collection as ArangoCollection;
use App\Core\Contracts\Validation\ValidationInterface;

/**
 * Abstract common operations to an collection
 *
 * @package App\Collections
 * @since 1.0
 * @author Lucas S. Vieira
 */
abstract class Collection implements ValidationInterface
{
    /**
     * @var string Collection name
     */
    public $collection;

    /**
     * @var $connection ArangoDb connection
     */
    protected $connection;

    /**
     * @var $collectionHandler CollectionHandler for repository
     */
    protected $collectionHandler;

    /**
     * @var $documentHandler DocumentHandler for repository
     */
    protected $documentHandler;


    public function __construct(Container $container)
    {
        $this->connection = $container['arango'];

        $this->collectionHandler = new CollectionHandler($this->connection);
        $this->documentHandler = new DocumentHandler($this->connection);

        // Create collection if not exists
        if (!$this->collectionHandler->has($this->collection)) {
            $this->collectionHandler->create(new ArangoCollection($this->collection));
        }
    }

    /**
     * Returns all documents from Collection
     *
     * @return \ArangoDBClient\Cursor
     */
    public function all()
    {
        $collection = $this->collectionHandler->get($this->collection);
        return $this->collectionHandler->all($collection->getId());
    }

    /**
     * Returns a given document from Collection
     *
     * @param $key
     * @return null|Document
     * @throws ServerException
     */
    public function find($key)
    {
        try {
            if ($this->documentHandler->has($this->collection, $key)) {
                return $this->documentHandler->get($this->collection, $key);
            };
        } catch (ServerException $exception) {
            if ($exception->getServerCode() != 1202) {
                throw $exception;
            }
        }

        return null;
    }

    /**
     * Create and save a new document
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        $document = new Document();

        foreach ($data as $key => $value) {
            $document->set($key, $value);
        }

        return $this->documentHandler->save($this->collection, $document);
    }

    /**
     * Updates a given document from Collection
     *
     * @param $id
     * @param array $data
     * @return bool|null
     */
    public function update($id, array $data)
    {
        $document = $this->find($id);

        if ($document) {
            foreach ($data as $key => $value) {
                $document->set($key, $value);
            }

            return $this->documentHandler->update($document);
        }

        return null;
    }

    /**
     * Delete a given document from collection
     *
     * @param $key
     * @return bool|null
     */
    public function delete($key)
    {
        $document = $this->find($key);

        if ($document) {
            return $this->documentHandler->remove($document);
        }

        return null;
    }

    /**
     * Collection name
     * @return string
     */
    public function getCollection(): string
    {
        return $this->collection;
    }
}