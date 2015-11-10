# Aura.Payload

You use a _Payload_ as a data transfer object to send domain-layer results to
your user-interface layer, along with meta-data indicating the meaning of the
domain results.

## Getting Started

Instantiating a _Payload_ object is straighforward:

```php
<?php
use Aura\Payload\Payload;

$payload = new Payload();
?>
```

You can then set the payload status and domain output, along with error codes,
error messages, the input as received by the domain layer, and any extras you
like.

While this may suffice for your particular implementation, there is also a
factory object to allow each call to return its own payload.

```php
<?php
use Aura\Payload\PayloadFactory;

$payloadFactory = new PayloadFactory();
$payload = $payloadFactory->newInstance();
?>
```

## Methods

Use these methods in your domain layer to modify the _Payload_. (All `set*()`
methods return the _Payload_ object itself, so you can chain the methods
fluently.)

- `setStatus()`: Sets the payload status in terms of the domain layer.

- `setInput()`: Sets the input as received by the domain layer.

- `setOutput()`: Sets the output produced by the domain layer.

- `setMessages()`: Sets the messages reported by the domain layer.

- `setExtras()`: Sets "extra" values produced by the domain layer.

Your calling code can then examine the payload object using the `get*()`
complements to the the `set*()` methods.

- `getStatus()`: Gets the payload status in terms of the domain layer.

- `getInput()`: Gets the input as received by the domain layer.

- `getOutput()`: Gets the output produced by the domain layer.

- `getMessages()`: Gets the messages reported by the domain layer.

- `getExtras()`: Gets "extra" values produced by the domain layer.

## Status Values

Several generic status values are available as constants on the
_Aura\Payload_Interface\PayloadStatus_ class:

- `PayloadStatus::ACCEPTED`: A command has been accepted for later processing.
- `PayloadStatus::AUTHENTICATED`: An authentication attempt succeeded.
- `PayloadStatus::AUTHORIZED`: An authorization request succeeded.
- `PayloadStatus::CREATED`: A creation attempt succeeded.
- `PayloadStatus::DELETED`: A deletion attempt succeeded.
- `PayloadStatus::ERROR`: There was a major error of some sort.
- `PayloadStatus::FAILURE`: There was a generic failure of some sort.
- `PayloadStatus::FOUND`: A query successfullly returned results.
- `PayloadStatus::NOT_ACCEPTED`: A command failed to be accepted.
- `PayloadStatus::NOT_AUTHENTICATED`: The user is not authenticated.
- `PayloadStatus::NOT_AUTHORIZED`: The user is not authorized for the action.
- `PayloadStatus::NOT_CREATED`: A creation attempt failed.
- `PayloadStatus::NOT_DELETED`: A deletion attempt failed.
- `PayloadStatus::NOT_FOUND`: A query failed to return results.
- `PayloadStatus::NOT_UPDATED`: An update attempt failed.
- `PayloadStatus::NOT_VALID`: User input was invalid.
- `PayloadStatus::PROCESSING`: A command is in-process but not finished.
- `PayloadStatus::SUCCESS`: There was a generic success of some sort.
- `PayloadStatus::UPDATED`: An update attempt succeeded.
- `PayloadStatus::VALID`: User input was valid.

You should consider creating your own domain-specific payload statuses as well.

Your user-interface layer can use these to determine how to process and present
the domain objects retrieved via `Payload::getOutput()`.

## Example

Here is a naive example Application Service class that uses a _Payload_ to
return its results. Note how:

- the `browsePosts()` method returns either `FOUND` or `NOT_FOUND` payloads;
- the `readPost()` method also returns either `FOUND` or `NOT_FOUND` payloads;
- the `editPost()` method returns ...
    - ... a `NOT_FOUND` payload if the `$id` does not exist,
    - ... a `NOT_AUTHORIZED` payload if the user does not own the post,
    - ... a `NOT_VALID` payload for invalid input,
    - ... or an `UPDATED` payload on success;
- the `addPost()` method returns ...
    - ... a `NOT_VALID` payload for invalid input,
    - ... or a `CREATED` payload on success;
- the `deletePost()` method returns ...
    - ... a `NOT_FOUND` payload if the `$id` does not exist,
    - ... a `NOT_AUTHORIZED` payload if the user does not own the post,
    - ... or a `DELETED` payload on success.

Any raised _Exception_ gets transformed into an `ERROR` payload, with the
exception and the input that led to the problem.

When your user-interface code receives the _Payload_, it can examine the payload
status to discover exactly what happened in the domain layer, then determine how
to present the information from the domain.

```php
<?php
namespace App\Blog;

use Aura\Payload\PayloadFactory;
use Aura\Payload_Interface\PayloadStatus;
use Exception;

class ApplicationService
{
    protected $user;
    protected $mapper;
    protected $filter;
    protected $payloadFactory;

    public function __construct(
        User $user,
        BlogMapper $mapper,
        BlogFilter $filter,
        PayloadFactory $payloadFactory
    ) {
        $this->user = $user;
        $this->mapper = $mapper;
        $this->filter = $filter;
        $this->payloadFactory = $payloadFactory;
    }

    public function browsePosts($page = 1, $perPage = 10)
    {
        $payload = $this->payloadFactory->newInstance();

        try {

            $posts = $this->mapper->fetchAllByPage($page, $perPage);
            if (! $posts) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_FOUND)
                    ->setInput(func_get_args());
            }

            return $payload
                ->setStatus(PayloadStatus::FOUND)
                ->setOutput($posts);

        } catch (Exception $e) {
            return $this->error($e, func_get_args());
        }
    }

    public function readPost($id)
    {
        $payload = $this->payloadFactory->newInstance();

        try {

            $post = $this->mapper->fetchOneById($id);
            if (! $post) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_FOUND)
                    ->setInput(func_get_args());
            }

            return $payload
                ->setStatus(PayloadStatus::FOUND)
                ->setOutput($post);

        } catch (Exception $e) {
            return $this->error($e, func_get_args());
        }
    }

    public function editPost($id, array $input)
    {
        $payload = $this->payloadFactory->newInstance();

        try {

            $post = $this->mapper->fetchOneById($id);
            if (! $post) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_FOUND)
                    ->setInput(func_get_args());
            }

            if (! $post->isOwnedBy($user)) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_AUTHORIZED)
                    ->setInput(func_get_args());
            }

            $post->setData($input);
            if (! $this->filter->forUpdate($post)) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_VALID)
                    ->setInput($input)
                    ->setOutput($post)
                    ->setMessages($this->filter->getMessages());
            }

            $this->mapper->update($post);
            return $payload
                ->setStatus(PayloadStatus::UPDATED)
                ->setOutput($post);

        } catch (Exception $e) {
            return $this->error($e, func_get_args());
        }
    }

    public function addPost(array $input)
    {
        $payload = $this->payloadFactory->newInstance();

        try {

            $post = $this->mapper->newPost($input);
            if (! $this->filter->forInsert($post)) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_VALID)
                    ->setInput($input)
                    ->setOutput($post)
                    ->setMessages($this->filter->getMessages());
            }

            $this->mapper->create($post);
            return $payload
                ->setStatus(PayloadStatus::CREATED)
                ->setOutput($post);

        } catch (Exception $e) {
            return $this->error($e, func_get_args());
        }
    }

    public function deletePost($id)
    {
        $payload = $this->payloadFactory->newInstance();

        try {

            $post = $this->mapper->fetchOneById($id);
            if (! $post) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_FOUND)
                    ->setInput(func_get_args());
            }

            if (! $post->isOwnedBy($user)) {
                return $payload
                    ->setStatus(PayloadStatus::NOT_AUTHORIZED)
                    ->setInput(func_get_args());
            }

            $this->mapper->delete($post);
            return $payload
                ->setStatus(PayloadStatus::DELETED)
                ->setOutput($post);

        } catch (Exception $e) {
            return $this->error($e, func_get_args());
        }
    }

    protected function error(Exception $e, array $args)
    {
        $payload = $this->payloadFactory->newInstance();
        return $payload
            ->setStatus(PayloadStatus::ERROR)
            ->setInput($args)
            ->setOutput($e);
    }
}
?>
```
