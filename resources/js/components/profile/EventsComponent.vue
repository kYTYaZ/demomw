<template>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <div class="h6 title">Green Goo’s Events</div>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/svg-icons//sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="ui-block">

                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">UPCOMING EVENTS 2016</h6>
                        </div>


                        <table class="event-item-table">
                            <tbody>
                                <tr class="event-item">

                                    <td class="upcoming">
                                        <div class="date-event">

                                            <svg class="olymp-small-calendar-icon"><use xlink:href="/svg-icons//sprites/icons.svg#olymp-small-calendar-icon"></use></svg>

                                            <span class="day">28</span>
                                            <span class="month">may</span>
                                        </div>
                                    </td>
                                    <td class="author">
                                        <div class="event-author inline-items">
                                            <div class="author-thumb">
                                                <img src="/img/avatar66-sm.jpg" alt="author">
                                            </div>
                                            <div class="author-date">
                                                <a href="#" class="author-name h6">Green Goo in Gotham</a>
                                                <time class="published" datetime="2017-03-24T18:18">Saturday at 9:00pm</time>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="location">
                                        <div class="place inline-items">
                                            <svg class="olymp-add-a-place-icon"><use xlink:href="/svg-icons//sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                            <span>Gotham Bar</span>
                                        </div>
                                    </td>
                                    <td class="description">
                                        <p class="description">We’ll be playing in the Gotham Bar in May. Come and have a great time with us! Entry: $12</p>
                                    </td>
                                    <td class="users">
                                        <ul class="friends-harmonic">
                                            <li>
                                                <a href="#">
                                                    <img src="/img/friend-harmonic5.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/img/friend-harmonic10.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/img/friend-harmonic7.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/img/friend-harmonic8.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/img/friend-harmonic2.jpg" alt="friend">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users bg-breez">+24</a>
                                            </li>

                                            <li class="with-text">
                                                Will Assist
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="add-event">
                                        <a href="20-CalendarAndEvents-MonthlyCalendar.html" class="btn btn-breez btn-sm">Add to Calendar</a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">PAST EVENTS</h6>
                        </div>

                        <div class="no-past-events">
                            <svg class="olymp-month-calendar-icon"><use xlink:href="/svg-icons//sprites/icons.svg#olymp-month-calendar-icon"></use></svg>
                            <span>There are no past events <br/>to show</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
