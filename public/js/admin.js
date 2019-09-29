/* Part 32 */
function datesBetween(startDt, endDt) {
  var between = [];
  var currentDate = new Date(startDt);
  var end = new Date(endDt);

  while (currentDate <= end) {
    between.push($.datepicker.formatDate('mm/dd/yy', new Date(currentDate)));
    currentDate.setDate(currentDate.getDate() + 1);
  }

  return between;
}
/* Part 30 */


var Ajax = {
  get: function get(url, _success) {
    var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;

    var _beforeSend = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;

    $.ajax({
      cache: false,
      url: base_url + '/' + url,
      type: "GET",
      data: data,
      success: function success(response) {
        App[_success](response);
      },
      beforeSend: function beforeSend() {
        if (_beforeSend) App[_beforeSend]();
      }
    });
  },

  /* Part 50 */
  set: function set() {
    var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    var url = arguments.length > 1 ? arguments[1] : undefined;

    var _success2 = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;

    $.ajax({
      cache: false,
      url: base_url + '/' + url,
      type: "GET",
      dataType: "json",
      data: data,
      success: function success(response) {
        if (_success2) App[_success2](response);
      }
    });
  }
};
/* Part 30 */

var App = {
  timestamp: null,

  /* Part 51 */
  idsOfNotShownNotifications: [],

  /* Part 52 */
  GetReservationData: function GetReservationData(id, calendar_id
  /* Part 32 */
  , date) {
    App.calendar_id = calendar_id;
    /* Part 32 */

    Ajax.get('ajaxGetReservationData?fromWebApp=1', 'AfterGetReservationData', {
      room_id: id,
      date: date
    }, 'BeforeGetReservationData');
    /* Part 31 ?fromWebApp=1 */
  },
  BeforeGetReservationData: function BeforeGetReservationData() {
    $('.loader_' + App.calendar_id).hide();
    /* Part 32 */

    $('.hidden_' + App.calendar_id).show();
    /* Part 32 */
  },
  AfterGetReservationData: function AfterGetReservationData(response) {
    $('.hidden_' + App.calendar_id + " .reservation_data_room_number").html(response.room_number);
    /* Part 32 */

    $('.hidden_' + App.calendar_id + " .reservation_data_day_in").html(response.day_in);
    /* Part 33 */

    $('.hidden_' + App.calendar_id + " .reservation_data_day_out").html(response.day_out);
    /* Part 33 */

    $('.hidden_' + App.calendar_id + " .reservation_data_person").html(response.FullName);
    /* Part 33 */

    $('.hidden_' + App.calendar_id + " .reservation_data_person").attr('href', response.userLink);
    /* Part 33 */

    $('.hidden_' + App.calendar_id + " .reservation_data_delete_reservation").attr('href', response.deleteResLink);
    /* Part 33 */

    /* Part 33 */

    if (response.status) {
      $('.hidden_' + App.calendar_id + " .reservation_data_confirm_reservation").removeAttr('href');
      $('.hidden_' + App.calendar_id + " .reservation_data_confirm_reservation").attr('disabled', 'disabled');
    } else {
      $('.hidden_' + App.calendar_id + " .reservation_data_confirm_reservation").attr('href', response.confirmResLink);
    }
  },

  /* Part 50 */
  SetReadNotification: function SetReadNotification(id) {
    Ajax.set({
      id: id
    }, 'ajaxSetReadNotification?fromWebApp=1');
  },

  /* Part 50 */
  GetNotShownNotifications: function GetNotShownNotifications() {
    /* Part 51 */
    Ajax.get("ajaxGetNotShownNotifications?fromWebApp=1&timestamp=" + App.timestamp, 'AfterGetNotShownNotifications');
  },

  /* Part 51 */
  AfterGetNotShownNotifications: function AfterGetNotShownNotifications(response) {
    var json = JSON.parse(response);
    /* Part 52 */

    App.timestamp = json['timestamp'];
    /* Part 52 */

    setTimeout(App.GetNotShownNotifications(), 100);
    /* Part 52 */

    /* Part 52 */

    if (jQuery.isEmptyObject(json['notifications'])) return;
    $('#app-notifications-count').show();
    /* Part 52 */

    $('#app-notifications-count').removeClass('hidden');
    /* Part 52 */

    /* Part 52 */

    for (var i = 0; i <= json['notifications'].length - 1; i++) {
      App.idsOfNotShownNotifications.push(json['notifications'][i].id);
      $('#app-notifications-count').html(parseInt($('#app-notifications-count').html()) + 1);
      $("#app-notifications-list").append('<li class="unread_notification"><a href="' + json['notifications'][i].id + '">' + json['notifications'][i].content + '</a></li>');
    }

    App.SetShownNotifications(App.idsOfNotShownNotifications);
    /* Part 52 */
  },

  /* Part 52 */
  SetShownNotifications: function SetShownNotifications(ids) {
    Ajax.set({
      idsOfNotShownNotifications: ids
    }, 'ajaxSetShownNotifications?fromWebApp=1');
  }
};
/* Part 34 */

$(document).on('click', '.dropdown', function (e) {
  e.stopPropagation();
});
/* Part 50 */

$(document).on("click", ".unread_notification", function (event) {
  event.preventDefault();
  $(this).removeClass('unread_notification');
  var ncount = parseInt($('#app-notifications-count').html());

  if (ncount > 0) {
    $('#app-notifications-count').html(ncount - 1);
    if (ncount == 1) $('#app-notifications-count').hide();
  }

  var idOfNotification = $(this).children().attr('href');
  $(this).children().removeAttr('href');
  App.SetReadNotification(idOfNotification);
});
/* Part 50 */

$(function () {
  App.GetNotShownNotifications();
});
