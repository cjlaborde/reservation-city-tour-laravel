@extends('layouts.backend') <!-- Part 5 -->

@section('content') <!-- Part 5 -->
<h2 class="sub-header">Booking calendar</h2>

@foreach( $objects as $o=>$object ) <!-- Part 29 -->

@php ( $o++ ) <!-- Part 29 -->
    <h3 class="red">{{ $object->name /* Part 29 */ }} object</h3>


    {{-- separate calendar sinder each room needs unique calendar --}}
    @foreach( $object->rooms as $r=>$room ) <!-- Part 29 -->

    <!-- Part 30 -->
    @push('scripts')
    <script>

    var eventDates{{ $o.$r }} = {}; /* Part 32 $o.$r */
    var datesConfirmed{{ $o.$r }} = []; /* Part 32 */
    var datesnotConfirmed{{ $o.$r }} = [];/* Part 32 */

    /* Part 32 */
    // 2 arrays with reservation dates. Confirmed and not confirmed
    @foreach($room->reservations as $reservation)

        @if ($reservation->status)
                datesConfirmed{{$o.$r}}.push(datesBetween(new Date('{{$reservation->day_in}}'), new Date('{{$reservation->day_out}}')));
        @else
                datesnotConfirmed{{$o.$r}}.push(datesBetween(new Date('{{$reservation->day_in}}'), new Date('{{$reservation->day_out}}')));
        @endif

    @endforeach

    datesConfirmed{{$o.$r}} = [].concat.apply([], datesConfirmed{{$o.$r}}); /* Part 32 */
    datesnotConfirmed{{$o.$r}} = [].concat.apply([], datesnotConfirmed{{$o.$r}}); /* Part 32 */


    for (var i = 0; i < datesConfirmed{{ $o.$r }}.length; i++) /* Part 32 $o.$r */
    {
        eventDates{{ $o.$r }}[ datesConfirmed{{ $o.$r }}[i] ] = 'confirmed'; /* Part 32 $o.$r */
    }

    var tmp{{ $o.$r }} = {}; /* Part 32 $o.$r */
    for (var i = 0; i < datesnotConfirmed{{ $o.$r }}.length; i++) /* Part 32 $o.$r */
    {
        tmp{{ $o.$r }}[ datesnotConfirmed{{ $o.$r }}[i] ] = 'notconfirmed'; /* Part 32 $o.$r */
    }


    Object.assign(eventDates{{ $o.$r }}, tmp{{ $o.$r }});  /* Part 32 $o.$r */


    $(function () {
        $(".reservation_calendar" + {{ $o.$r }}/* Part 32 */).datepicker({
            onSelect: function (date/* Part 32 data->date */) {
                // hide previous booking data
                $('.hidden_' + {{ $o.$r }}).hide(); /* Part 32 $o.$r */
                $('.loader_' + {{ $o.$r }}).show(); /* Part 32 $o.$r */

                App.GetReservationData({{ $room->id }}, {{ $o.$r }}, date ); /* Part 32 */

            },
            beforeShowDay: function (date)
            {
                var tmp = eventDates{{ $o.$r }}[ $.datepicker.formatDate('mm/dd/yy', date)]; /* Part 32 $o.$r */
    //            console.log(tmp);
                if (tmp)
                {
                    if (tmp == 'confirmed')
                        return [true, 'reservationconfirmed'];
                    else
                        return [true, 'reservationnotconfirmed'];
                } else
                    return [false, ''];

            }


        });
    });


    </script>
    @endpush

        <h4 class="blue"> Room {{ $room->room_number /* Part 29 */ }}</h4>

        <div class="row top-buffer">
            <div class="col-md-3">
                <div class="reservation_calendar{{ $o.$r/* Part 29 */}}"></div>
            </div>
            <div class="col-md-9">
                <div class="center-block loader loader_{{ $o.$r /* Part 29 */}}" style="display: none;"></div>
                <div class="hidden_{{ $o.$r /* Part 29 */}}" style="display: none;">


                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Room number</th>
                                    <th>Check in</th>
                                    <th>Check out</th>
                                    <th>Guest</th>

                                    <!-- Part 29 -->
                                    @if( Auth::user()->hasRole(['admin','owner']) )
                                    <th>Confirmation</th>
                                    @endif

                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="reservation_data_room_number"></td> <!-- Part 30 class -->
                                    <td class="reservation_data_day_in"></td> <!-- Part 30 class -->
                                    <td class="reservation_data_day_out"></td> <!-- Part 30 class -->
                                    <td><a class="reservation_data_person" target="_blank" href=""></a></td> <!-- Part 30 class -->
                                    <!-- Part 29 -->
                                    @if( Auth::user()->hasRole(['admin','owner']) )
                                    <td><a href="#" class="btn btn-primary btn-xs reservation_data_confirm_reservation keep_pos <?php /* Part 34 */?>">Confirm</a></td> <!-- Part 30 css class -->
                                    @endif

                                    <td><a class="reservation_data_delete_reservation keep_pos <?php /* Part 34 */?>" href=""><span class="glyphicon glyphicon-remove"></span></a></td> <!-- Part 30 css class -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <hr>

    @endforeach <!-- Part 29 -->

@endforeach <!-- Part 29 -->
@endsection <!-- Part 5 -->

