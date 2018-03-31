<?php

declare(strict_types=1);

/*
 * This file is part of Bitbucket API Client.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitbucket\Api\Repositories;

use Bitbucket\Api\Repositories\Issues\Attachments;
use Bitbucket\Api\Repositories\Issues\Changes;
use Bitbucket\Api\Repositories\Issues\Comments;
use Bitbucket\Api\Repositories\Issues\Vote;
use Bitbucket\Api\Repositories\Issues\Watch;

/**
 * The issues api class.
 *
 * @author Graham Campbell <graham@alt-thre.com>
 */
class Issues extends AbstractRepositoriesApi
{
    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function list(array $params = [])
    {
        $path = $this->buildIssuesPath();

        return $this->get($path, $params);
    }

    /**
     * @param array $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function create(array $params = [])
    {
        $path = $this->buildIssuesPath();

        return $this->post($path, $params);
    }

    /**
     * @param string $issue
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function show(string $issue, array $params = [])
    {
        $path = $this->buildIssuesPath($issue);

        return $this->get($path, $params);
    }

    /**
     * @param string $issue
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function update(string $issue, array $params = [])
    {
        $path = $this->buildIssuesPath($issue);

        return $this->put($path, $params);
    }

    /**
     * @param string $issue
     * @param array  $params
     *
     * @throws \Http\Client\Exception
     *
     * @return array
     */
    public function remove(string $issue, array $params = [])
    {
        $path = $this->buildIssuesPath($issue);

        return $this->delete($path, $params);
    }

    /**
     * @param string $issue
     *
     * @return \Bitbucket\Api\Repositories\Issues\Attachments
     */
    public function attachments(string $issue)
    {
        return new Attachments($this->getHttpClient(), $this->username, $this->repo, $issue);
    }

    /**
     * @param string $issue
     *
     * @return \Bitbucket\Api\Repositories\Issues\Changes
     */
    public function changes(string $issue)
    {
        return new Changes($this->getHttpClient(), $this->username, $this->repo, $issue);
    }

    /**
     * @param string $issue
     *
     * @return \Bitbucket\Api\Repositories\Issues\Comments
     */
    public function comments(string $issue)
    {
        return new Comments($this->getHttpClient(), $this->username, $this->repo, $issue);
    }

    /**
     * @param string $issue
     *
     * @return \Bitbucket\Api\Repositories\Issues\Vote
     */
    public function vote(string $issue)
    {
        return new Vote($this->getHttpClient(), $this->username, $this->repo, $issue);
    }

    /**
     * @param string $issue
     *
     * @return \Bitbucket\Api\Repositories\Issues\Watch
     */
    public function watch(string $issue)
    {
        return new Watch($this->getHttpClient(), $this->username, $this->repo, $issue);
    }

    /**
     * Build the issues path from the given parts.
     *
     * @param string[] $parts
     *
     * @throws \Bitbucket\Exception\InvalidArgumentException
     *
     * @return string
     */
    protected function buildIssuesPath(string ...$parts)
    {
        return static::buildPath('repositories', $this->username, 'issues', ...$parts);
    }
}
