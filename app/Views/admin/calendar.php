<?= $this->extend('admin/layout') ?>

<?= $this->section('style') ?>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    .fc-header-toolbar {
        padding: 1.5rem !important;
        background: white;
        border-radius: 2rem 2rem 0 0;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 0 !important;
        flex-direction: column;
        gap: 1rem;
    }
    @media (min-width: 768px) {
        .fc-header-toolbar {
            padding: 2rem !important;
            flex-direction: row;
            gap: 0;
        }
    }
    .fc-view-harness {
        background: white;
        border-radius: 0 0 2rem 2rem;
        padding: 0.5rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }
    @media (min-width: 768px) {
        .fc-view-harness {
            padding: 1rem;
        }
    }
    .fc-col-header-cell {
        background: #f8fafc;
        padding: 8px 0 !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        font-size: 9px;
        letter-spacing: 0.05em;
        color: #64748b;
    }
    @media (min-width: 768px) {
        .fc-col-header-cell {
            padding: 12px 0 !important;
            font-size: 10px;
            letter-spacing: 0.1em;
        }
    }
    .fc-daygrid-day-number {
        font-weight: 800;
        font-size: 0.7rem;
        color: #1e293b;
        padding: 4px !important;
    }
    @media (min-width: 768px) {
        .fc-daygrid-day-number {
            font-size: 0.8rem;
            padding: 8px !important;
        }
    }
    .fc-event {
        border-radius: 6px !important;
        padding: 2px 4px !important;
        font-weight: 800 !important;
        font-size: 9px !important;
        border: none !important;
        transition: all 0.3s;
        cursor: pointer;
        white-space: normal !important;
    }
    @media (min-width: 768px) {
        .fc-event {
            border-radius: 8px !important;
            padding: 4px 8px !important;
            font-size: 10px !important;
        }
    }
    .fc-event:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
    .fc-button-primary {
        background: #0f172a !important;
        border: none !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        font-size: 9px !important;
        padding: 8px 12px !important;
        border-radius: 10px !important;
    }
    @media (min-width: 768px) {
        .fc-button-primary {
            font-size: 10px !important;
            padding: 10px 20px !important;
            border-radius: 12px !important;
        }
    }
    .fc-button-primary:hover {
        background: #dc2626 !important;
    }
    .fc-toolbar-title {
        font-weight: 900 !important;
        letter-spacing: -0.02em;
        color: #0f172a;
        font-size: 1.2rem !important;
    }
    @media (min-width: 768px) {
        .fc-toolbar-title {
            font-size: 1.75rem !important;
        }
    }
    .fc-scrollgrid { border: none !important; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="calendar-wrapper">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Content <span class="text-orange-500">Calendar</span></h1>
            <p class="text-slate-500 font-medium">View and manage your news publishing schedule.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= base_url('admin/news/create') ?>" class="px-6 py-2 bg-slate-900 text-white rounded-2xl text-sm font-black shadow-lg hover:bg-red-600 transition flex items-center gap-2">
                <i class="fas fa-plus"></i> Add News
            </a>
        </div>
    </div>

    <div id="calendar"></div>
</div>

<?= $this->section('scripts') ?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var isMobile = window.innerWidth < 768;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: isMobile ? 'listWeek' : 'dayGridMonth',
            headerToolbar: {
                left: isMobile ? 'prev,next' : 'prev,next today',
                center: 'title',
                right: isMobile ? 'listWeek,dayGridDay' : 'dayGridMonth,timeGridWeek,listWeek'
            },
            height: 'auto',
            events: <?= $events ?>,
            eventClick: function(info) {
                if (info.event.url) {
                    window.open(info.event.url, "_blank");
                    info.jsEvent.preventDefault();
                }
            },
            windowResize: function(view) {
                if (window.innerWidth < 768) {
                    calendar.changeView('listWeek');
                } else {
                    calendar.changeView('dayGridMonth');
                }
            }
        });
        calendar.render();
        console.log("Content Calendar Initialized.");
    });
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
