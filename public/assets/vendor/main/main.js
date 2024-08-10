(function($) {

    "use strict";

    function DateTime() {
        function getDaySuffix(a) {
            var b = "" + a,
                c = b.length,
                d = parseInt(b.substring(c-2, c-1)),
                e = parseInt(b.substring(c-1));
            if (c == 2 && d == 1) return " ke";
            switch(e) {
                case 1:
                    return "st";
                    break;
                case 2:
                    return "nd";
                    break;
                case 3:
                    return "rd";
                    break;
                default:
                    return " ";
                    break;
            };
        };

        this.getDoY = function(a) {
            var b = new Date(a.getFullYear(),0,1);
            return Math.ceil((a - b) / 86400000);
        }

        this.date = arguments.length == 0 ? new Date() : new Date(arguments);

        this.weekdays = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        this.months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        this.daySuf = new Array(" ", " ", " ", " ");

        this.day = {
            index: {
                week: "0" + this.date.getDay(),
                month: (this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()
            },
            name: this.weekdays[this.date.getDay()],
            of: {
                week: ((this.date.getDay() < 10) ? "0" + this.date.getDay() : this.date.getDay()) + getDaySuffix(this.date.getDay()),
                month: ((this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()) + getDaySuffix(this.date.getDate())
            }
        }

        this.month = {
            index: (this.date.getMonth() + 1) < 10 ? "0" + (this.date.getMonth() + 1) : this.date.getMonth() + 1,
            name: this.months[this.date.getMonth()]
        };

        this.year = this.date.getFullYear();

        this.sym = {
            d: {
                d: this.date.getDate(),
                dd: (this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate(),
                ddd: this.weekdays[this.date.getDay()].substring(0, 3),
                dddd: this.weekdays[this.date.getDay()],
                ddddd: ((this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()) + getDaySuffix(this.date.getDate()),
                m: this.date.getMonth() + 1,
                mm: (this.date.getMonth() + 1) < 10 ? "0" + (this.date.getMonth() + 1) : this.date.getMonth() + 1,
                mmm: this.months[this.date.getMonth()].substring(0, 3),
                mmmm: this.months[this.date.getMonth()],
                yy: (""+this.date.getFullYear()).substr(2, 2),
                yyyy: this.date.getFullYear()
            }
        };

        this.formats = {
            pretty: {
                a: this.sym.d.dddd,
                b: this.sym.d.ddddd,
                c: this.sym.d.mmmm,
                d: this.sym.d.yyyy
            }
        };
    };

    var dt = new DateTime();
    $('.day').text(dt.formats.pretty.a);
    $('.date').text(dt.formats.pretty.b);
    $('.month').text(dt.formats.pretty.c);
    $('.year').text(dt.formats.pretty.d);

})(jQuery);
