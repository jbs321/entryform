<div class="contenido">
    <div class="ticket">
        <div class="hqr">
            <div class="column left-one"></div>
            <div class="column center">
                <div id="qrcode"></div>
            </div>
            <div class="column right-one"></div>
        </div>
    </div>
    <div class="details">
        <div class="tinfo">
            attendee
        </div>
        <div class="tdata name">
            @yield('name')
        </div>
        <div class="tinfo">
            ticket
        </div>
        <div class="tdata">
            Monday General Admission
        </div>
        <div class="tinfo">
            event
        </div>
        <div class="tdata">
            Goal Summit NYC 2016 BetterWorks
        </div>
        <div class="masinfo">
            <div class="left">
                <div class="tinfo">
                    date
                </div>
                <div class="tdata nesp">
                    MON. APR 09, 7:00PM
                </div>
            </div>
            <div class="right">
                <div class="tinfo">
                    location
                </div>
                <div class="tdata nesp">
                    Octavia Street. San Francisco, CA
                </div>
            </div>
        </div>

        <div class="link">
            <a href="#">SEE MORE</a>
        </div>
    </div>
</div>
</div>

<style>@import url('https://fonts.googleapis.com/css?family=Roboto:300,400');
    .float-left {
        float:left;
        width:300px; // or 33% for equal width independent of parent width
    }

    .contenido {
        margin: 30px;
        max-height: 430px;
        max-width: 245px;
        overflow: hidden;
        box-shadow: 0 0 10px rgb(202, 202, 204);
        background-color:;
        border-radius: 2px;
    }
    .details {
        padding: 26px;
        background:white;
        border-top: 1px dashed #c3c3c3;
    }
    .tinfo {
        font-size: 0.5em;
        font-weight: 300;
        color: #c3c3c3;
        font-family: 'Roboto', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin:7px 0;
    }

    .tdata {
        font-size: 0.7em;
        font-weight: 400;
        font-family: 'Roboto', sans-serif;
        letter-spacing: 0.5px;
        margin:7px 0;
    }

    .name {
        font-size: 1.3em;
        font-weight: 300;
    }

    .link {
        text-align: center;
        margin-top:10px;
    }

    a {
        text-decoration: none;
        color:#55C9E6;
        font-weight: 400;
        font-family: 'Roboto', sans-serif;
        letter-spacing: 0.7px;
        font-size: 0.7em;
    }
    .hqr{
        display: table;
        width: 100%;
        table-layout: fixed;
        margin: 0px auto;
    }
    .left-one{
        background-repeat: no-repeat;
        background-image: radial-gradient(circle at 0 96% , rgba(0,0,0,0) .2em, gray .3em, white .1em);
    }
    .right-one{
        background-repeat: no-repeat;
        background-image: radial-gradient(circle at 100% 96% , rgba(0,0,0,0) .2em, gray .3em, white .1em);
    }
    .column
    {
        display: table-cell;
        padding: 37px 0px;
    }
    .center{
        background:white;
    }

    #qrcode img{
        height:70px;
        width:70px;
        margin: 0 auto;
    }
    .masinfo{
        display:block;
    }
    .left,.right{
        width:49%;
        display:inline-table;
    }

    .nesp{
        letter-spacing: 0px;
    }
</style>