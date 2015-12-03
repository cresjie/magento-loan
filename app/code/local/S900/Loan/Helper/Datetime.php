<?php

class S900_Loan_Helper_Datetime extends DateTime{
	
	const DEFAULT_TO_STRING_FORMAT = 'Y-m-d H:i:s';

	protected static $toStringFormat = self::DEFAULT_TO_STRING_FORMAT;



	public function __toString()
    {
        return $this->format(static::$toStringFormat);

    }

    public function toDateString()
    {
        return $this->format('Y-m-d');
    }

    /**
     * Format the instance as a readable date
     *
     * @return string
     */
    public function toFormattedDateString()
    {
        return $this->format('M j, Y');
    }

    /**
     * Format the instance as time
     *
     * @return string
     */
    public function toTimeString()
    {
        return $this->format('H:i:s');
    }

    /**
     * Format the instance as date and time
     *
     * @return string
     */
    public function toDateTimeString()
    {
        return $this->format('Y-m-d H:i:s');
    }

    /**
     * Format the instance with day, date and time
     *
     * @return string
     */
    public function toDayDateTimeString()
    {
        return $this->format('D, M j, Y g:i A');
    }

    /**
     * Format the instance as ATOM
     *
     * @return string
     */
    public function toAtomString()
    {
        return $this->format(static::ATOM);
    }

    /**
     * Format the instance as COOKIE
     *
     * @return string
     */
    public function toCookieString()
    {
        return $this->format(static::COOKIE);
    }

    /**
     * Format the instance as ISO8601
     *
     * @return string
     */
    public function toIso8601String()
    {
        return $this->format(static::ISO8601);
    }

    /**
     * Format the instance as RFC822
     *
     * @return string
     */
    public function toRfc822String()
    {
        return $this->format(static::RFC822);
    }

    /**
     * Format the instance as RFC850
     *
     * @return string
     */
    public function toRfc850String()
    {
        return $this->format(static::RFC850);
    }

    /**
     * Format the instance as RFC1036
     *
     * @return string
     */
    public function toRfc1036String()
    {
        return $this->format(static::RFC1036);
    }

    /**
     * Format the instance as RFC1123
     *
     * @return string
     */
    public function toRfc1123String()
    {
        return $this->format(static::RFC1123);
    }

    /**
     * Format the instance as RFC2822
     *
     * @return string
     */
    public function toRfc2822String()
    {
        return $this->format(static::RFC2822);
    }

    /**
     * Format the instance as RFC3339
     *
     * @return string
     */
    public function toRfc3339String()
    {
        return $this->format(static::RFC3339);
    }

    /**
     * Format the instance as RSS
     *
     * @return string
     */
    public function toRssString()
    {
        return $this->format(static::RSS);
    }

    /**
     * Format the instance as W3C
     *
     * @return string
     */
    public function toW3cString()
    {
        return $this->format(static::W3C);
    }

	
}