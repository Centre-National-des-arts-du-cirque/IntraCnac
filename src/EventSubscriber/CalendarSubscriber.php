<?php

namespace App\EventSubscriber;

use App\Repository\EventRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private EventRepository $EventRepository,
        private UrlGeneratorInterface $router
    )
    {}

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $events = $this->EventRepository
        ->createQueryBuilder('event')
        ->where('event.DateBeg BETWEEN :start and :end OR event.DateEnd BETWEEN :start and :end')
        ->setParameter('start', $start->format('Y-m-d H:i:s'))
        ->setParameter('end', $end->format('Y-m-d H:i:s'))
        ->getQuery()
        ->getResult()
    ;
        
        foreach ($events as $eventCnac) {
            // this create the events with your data (here booking data) to fill calendar
            $CalendarEvent = new Event(
                $eventCnac->getLib(),
                $eventCnac->getDateBeg(),
                $eventCnac->getDateEnd() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $CalendarEvent->setOptions([
                'backgroundColor' =>$eventCnac->getTypeEvent()->getCalendarColor(),
                'borderColor' => $eventCnac->getTypeEvent()->getCalendarColor(),
            ]);
            

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($CalendarEvent);
        }
    }
}