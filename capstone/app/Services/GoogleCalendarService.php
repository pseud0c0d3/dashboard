<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json')); // Use storage_path
        $this->client->addScope(Google_Service_Calendar::CALENDAR);

        $this->service = new Google_Service_Calendar($this->client);
    }

    // Create event in Google Calendar
    public function createEvent($title, $start, $end, $description = null)
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => $title,
            'location' => 'Virtual',
            'description' => $description,
            'start' => [
                'dateTime' => $start,
                'timeZone' => 'UTC',
            ],
            'end' => [
                'dateTime' => $end,
                'timeZone' => 'UTC',
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ]);

        $calendarId = 'primary'; // Or your calendar ID
        $this->service->events->insert($calendarId, $event);
    }

    // Get events from Google Calendar
    public function getEvents()
    {
        $calendarId = 'primary'; // Or your calendar ID
        $optParams = [
            'maxResults' => 10, // Customize as needed
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'), // Get only future events
        ];

        $events = $this->service->events->listEvents($calendarId, $optParams);

        $eventArray = [];
        foreach ($events->getItems() as $event) {
            $eventArray[] = [
                'summary' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime(),
                'end' => $event->getEnd()->getDateTime(),
                'description' => $event->getDescription(),
            ];
        }

        return $eventArray;
    }
}
