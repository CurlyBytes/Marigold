<?php
namespace Marigold\Domain\SharedKernel\Exceptions;

// final class NotFound extends Exception
// {
//     use KnownProblem;
//     protected $message_template = "Resource with id :id not found";
// }
// ....

// // thow it with
// throw new NotFound::withProblem('NOT_FOUND', "", ["id"=>$id]);

//referrence = https://lessthan12ms.com/clean-exceptions-with-logging-and-translation.html
/**
 * This trait will add message translation to any exception.
 * The goal of this is to support every exception with string problem code and possible message
 */
trait KnownProblem
{
    /** @var  string code to look up in documentation like "112_EMAIL_INVALID" */
    protected $problem_code;
    /** @var  string for message template like "Email :email has invalid format" */
    protected $message_template;
    /** @var  array of data to use in template: ["email"=>"some@@example.org"] */
    protected $message_payload;
    
    /**
     * Will make a new exception with required data filled in
     *
     * @param string $problem_code
     * @param string $message_template
     * @param array  $message_payload
     */
    static public function withProblem(
        string $problem_code,
        string $message_template = "",
        array $message_payload = [],
        \Exception $prev = null
    ): self {
        $exception = new static(
            "Problem " . $problem_code . " \n " . self::getTranslatedMessage($message_template, $message_payload),
            0,
            $prev
        );
        // TASK can I do this without public setters?
        $exception->setProblemCode($problem_code);
        if($message_payload != []) {
            $exception->setMessagePayload($message_payload);
        }
        if($message_template != "") {
            $exception->setMessageTemplate($message_template);
        }
        
        return $exception;
    }
    
    /**
     * @param string $problem_code
     */
    public function setProblemCode(string $problem_code)
    {
        $this->problem_code = $problem_code;
    }
    
    /**
     * @param string $message_template
     */
    public function setMessageTemplate(string $message_template)
    {
        $this->message_template = $message_template;
    }
    
    /**
     * @param array $message_payload
     */
    public function setMessagePayload(array $message_payload)
    {
        $this->message_payload = $message_payload;
    }
    
    
    /**
     * Replace message template with values
     *
     * @param string $template in case I have a specific template to use
     *
     * @return string
     */
    static public function getTranslatedMessage($template, $payload = []): string
    {
        //
        // If some placeholders does not have leading : then add it (for just help to developer)
        //
        foreach($payload as $key => $value) {
            if($key[0] != ":") {
                $payload[ ":" . $key ] = $value;
                unset($payload[ $key ]);
            }
        }
        
        //
        // Make replacement
        //
        return strtr($template, $payload);
    }
    
    /**
     * @return string
     */
    public function getMessageTemplate(): string
    {
        return $this->message_template;
    }
    
    /**
     * @return array
     */
    public function getMessagePayload(): array
    {
        return $this->message_payload;
    }
    
    /**
     * @return string
     */
    public function getProblemCode(): string
    {
        return $this->problem_code;
    }
    
    
}