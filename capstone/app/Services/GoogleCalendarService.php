<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarService
{
    protected $client;
    protected $service;
    protected $calendarId;

    // public function __construct()
    // {
    //     // Initialize Google Client
    //     $this->client = new Google_Client();
    //     $this->client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS'));
    //     $this->client->addScope(Google_Service_Calendar::CALENDAR);

    //     $this->service = new Google_Service_Calendar($this->client);
    //     $this->calendarId = env('GOOGLE_CALENDAR_ID');
    // }
    public function __construct()
    {
        // Initialize Google Client
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json')); // Use storage_path
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
    
        $this->service = new Google_Service_Calendar($this->client);
        $this->calendarId = env('GOOGLE_CALENDAR_ID');
    }
    public function createEvent($title, $startDateTime, $endDateTime, $description = '')
{
    $event = new Google_Service_Calendar_Event([
        'summary' => $title,
        'start' => [
            'dateTime' => $startDateTime,
            'timeZone' => 'UTC',
        ],
        'end' => [
            'dateTime' => $endDateTime,
            'timeZone' => 'UTC',
        ],
        'description' => $description,  // Add description field
    ]);

    return $this->service->events->insert($this->calendarId, $event);
}

    public function deleteEvent($eventId)
    {
        return $this->service->events->delete($this->calendarId, $eventId);
    }

    public function updateEvent($eventId, $title, $startDateTime, $endDateTime)
    {
        $event = $this->service->events->get($this->calendarId, $eventId);

        $event->setSummary($title);
        $event->setStart(['dateTime' => $startDateTime, 'timeZone' => 'UTC']);
        $event->setEnd(['dateTime' => $endDateTime, 'timeZone' => 'UTC']);

        return $this->service->events->update($this->calendarId, $eventId, $event);
    }

    public function listEvents()
    {
        return $this->service->events->listEvents($this->calendarId)->getItems();
    }
}
