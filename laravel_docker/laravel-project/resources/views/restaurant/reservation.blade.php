<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レストランを予約する') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="width: 85%;margin: 70px auto;">
        <div id='calendar'></div>
    </div>



    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var restaurantId = @json($restaurant_id);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'ja',
                height: 'auto',
                firstDay: 1,
                headerToolbar: {
                    left: "dayGridMonth,listMonth",
                    center: "title",
                    right: "today prev,next"
                },
                slotDuration: '00:30:00',
                slotMinTime: "10:00:00",
                slotMaxTime: "24:00:00",
                events: '/reservations/events?restaurant_id=' + restaurantId,
                eventDisplay: 'block',
                allDaySlot: false,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: false
                },
                headerToolbar: {
                    left: "dayGridMonth,timeGridWeek,listWeek", // 週表示ボタン追加
                    center: "title",
                    right: "today prev,next"
                },
                views: {
                    timeGridWeek: {
                        buttonText: '週表示' // 日本語ラベル
                    }
                },
                eventContent: function (arg) {
                    return { html: `<div class="fc-event-symbol">${arg.event.title}</div>` };
                },
                listDayFormat: { 
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    },
    listDaySideFormat: false, // 日付表示を非表示
    eventContent: function(arg) {
        return {
            html: `<div class="flex items-center">
                <span class="mr-2">${arg.event.title}</span>
                <span class="text-sm">
                    ${arg.timeText}
                </span>
            </div>`
        };
    },
                nowIndicator: true,
                navLinks: true,
                eventClick: function (info) {
                    if (info.event.title === '○') {
                        window.location.href = info.event.extendedProps.url;
                    } else {
                        alert('この時間は予約済みです');
                    }
                    info.jsEvent.preventDefault();
                },
                eventDidMount: function (info) {
                    if (info.event.title === '○') {
                        info.el.style.cursor = 'pointer';
                        info.el.title = 'クリックで予約';
                    } else {
                        info.el.style.cursor = 'not-allowed';
                    }
                },
                buttonText: {
                    today: '今月',
                    month: '月',
                    list: 'リスト'
                },
                @if(request()->has('refresh'))
                    calendar.refetchEvents();
                @endif
                noEventsContent: 'スケジュールはありません',
            });
        calendar.render();
        });
    </script>

    <style>
        .fc-event {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .fc-event-title {
            display: block;
            margin: 0 auto;
        }

        /* 時間表示を非表示 */
        .fc-time-grid .fc-slats td {
            font-size: 0 !important;
        }

        /* セルの高さを調整 */
        .fc-time-grid .fc-slats tr {
            height: 40px;
        }

        .fc-event-symbol {
            font-size: 24px;
            text-align: center;
            width: 100%;
        }

        .fc-time-grid .fc-slats td {
            height: 60px !important;
            /* セルの高さを統一 */
        }

        .fc-event-time {
            display: none !important;
        }

        /* 週表示ボタン強調 */
        .fc-timeGridWeek-button {
            background-color: #4299e1 !important;
            color: white !important;
        }

        /* リスト表示調整 */
.fc-list-event {
    padding: 8px 10px;
}
.fc-list-event-time {
    font-size: 14px;
    margin-left: 10px;
}
    </style>
</x-app-layout>