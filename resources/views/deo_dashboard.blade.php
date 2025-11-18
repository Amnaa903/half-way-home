
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DPMIS</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <style>
      .card {
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 3px 3px 6px;
        background-color: #C7EAE7 !important; /* Light color for card background */
      }
      .cardimages {
        margin-top: 20px;
        height: 80px;
        width: 80px;
        margin-bottom: 8px; /* Small space below image */
      }
      .card-body {
        padding: 5px 15px 15px; /* Slightly reduced top padding */
        background-color: #C7EAE7 !important; /* Light color for card body */
      }
      .colstyle {
        text-align: center;
        padding: 10px;
      }
      .footerlogo {
        text-align: center;
        height: 30px;
        width: 30px;
        margin: 20px;
      }
      .vl {
        border-left: 4px solid white;
        height: 50px;
        position: absolute;
        left: 50%;
        top: 20px;
      }
      .card[data-clickable="true"] {
        cursor: pointer;
      }
      @media (max-width: 576px) {
        .card {
          width: 195px;
          font-size: 14px;
        }
      }
      .nav {
        margin-top: 5px; /* Small space above nav */
        display: block;
        text-align: center;
        font-family: 'Segoe UI';
      }
      .nav li {
        display: inline-block;
        list-style: none;
      }
      .nav .button-dropdown {
        position: relative;
      }
      .nav li a {
        display: block;
        color: #FFFFFF;
        background-color: #3D7C77;
        padding: 10px 20px;
        text-decoration: none;
      }
      .nav li a:hover {
        background: linear-gradient(45deg, #2A9D8F, #264653);
        color: #FFFFFF;
      }
      .nav li a span {
        display: inline-block;
        margin-left: 5px;
        font-size: 10px;
        color: #FFFFFF;
      }
      .nav li .dropdown-menu {
        display: none;
        position: absolute;
        left: 0;
        padding: 0;
        margin: 0;
        text-align: left;
        background-color: #2C7073;
      }
      .nav li .dropdown-menu.active {
        display: block;
      }
      .nav li .dropdown-menu a {
        width: 200px;
        color: #FFFFFF;
      }
      .nav li .dropdown-menu a:hover {
        background: linear-gradient(45deg, #2A9D8F, #264653);
        color: #FFFFFF;
      }
      .submit {
        background-color: #3D7C77;
        border-radius: 10px;
        padding: 2px;
        color: #FFFFFF;
        font-size: 20px;
        width: 70px;
        height: 35px;
      }
      .submit:hover {
        background: linear-gradient(45deg, #2A9D8F, #264653);
        color: #FFFFFF;
      }
    </style>
  </head>
  <body style="background-color: #C7EAE7 !important;"> <!-- Light color for cards background -->
    <nav class="navbar" style="background-color: #3D7C77">
      <a href="/"><button class="button submit">BACK</button></a>
      <span
        style="color: #FFFFFF; font-size: 2vw; text-align: center"
        class="navbar-brand h4 ml-auto"
      >Half Way Home</span>
      <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              DEO
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="http://127.0.0.1:8001/logout"
                 onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="http://127.0.0.1:8001/logout" method="POST" class="d-none">
                <input type="hidden" name="_token" value="a3d4xaLb4YIy7xMLXqOgwc73oWDk56l2MmkaP0by">              </form>
            </div>
          </li>
              </ul>
    </nav>
    <div class="container-fluid" style="background-color: #C7EAE7 !important;"> <!-- Light color for cards background -->
      <div class="row" style="background-color: #C7EAE7 !important;"> <!-- Light color for cards background -->
        <div class="col-sm-12 col-md-3">
          <div class="card mx-auto">
            <img
              src="images/rf.png"
              class="card-img-top cardimages mx-auto logo3"
              alt="..."
            />
            <div class="card-body">
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Registration <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="http://127.0.0.1:8001/admissions.registerlist">Pending Registration</a>
                    </li>
                    <li>
                      <a href="http://127.0.0.1:8001/editlist">Again Registration</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-3">
          <div class="card mx-auto">
            <img
              src="images/mr.png"
              class="card-img-top cardimages mx-auto"
              alt="..."
            />
            <div class="card-body">
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle">
                    Medical Form
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="http://127.0.0.1:8001/indexmed">Medical Form</a>
                    </li>
                    <li>
                      <a href="http://127.0.0.1:8001/miindex">Medical List</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-3">
          <div class="card ar mx-auto">
            <img
              src="images/discharge.png"
              class="card-img-top cardimages mx-auto"
              alt="..."
            />
            <div class="card-body">
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle">
                    Discharge Form
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="http://127.0.0.1:8001/pending-discharge/list">Pending Discharge List</a>
                    </li>
                    <li>
                      <a href="http://127.0.0.1:8001/diindex">Discharged Residents</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-3">
          <div class="card mx-auto">
            <img
              src="images/lor.png"
              class="card-img-top cardimages mx-auto"
              alt="..."
            />
            <div class="card-body">
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle">
                    List of Residents
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="http://127.0.0.1:8001/ohindex">Current Residents</a>
                    </li>
                    <li>
                      <a href="http://127.0.0.1:8001/allindex">Registered Residents</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="background-color: #C7EAE7 !important;"> <!-- Light color for cards background -->
        <div class="col-sm-12 col-md-3">
          <div class="card mx-auto">
            <img
              src="images/report.png"
              class="card-img-top cardimages mx-auto"
              alt="..."
            />
            <div class="card-body">
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle">
                    Reports
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="/monthlyReport">Monthly Reports</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="background-color: white">
        <div
          class="col-sm-0 col-md-4"
          style="text-align: center; margin-top: 5px"
        ></div>
        <div
          class="col-sm-12 col-md-4"
          style="text-align: center; margin-top: 5px">
          <img style="width: 50px" src="images/PITBLOGO.png" />
          <small><b>A Project of Government of Punjab</b></small>
          <img style="width: 60px" src="images/swd.png" />
        </div>
        <div
          class="col-sm-0 col-md-4"
          style="text-align: center; margin-top: 5px"
        ></div>
      </div>
    </div>
  </body>
  <script>
    $(document).ready(() => {
      $(document.body).on("click", ".card[data-clickable=true]", (e) => {
        var href = $(e.currentTarget).data("href");
        window.location = href;
      });
    });
    jQuery(document).ready(function (e) {
      function t(t) {
        e(t).bind("click", function (t) {
          t.preventDefault();
          e(this).parent().fadeOut()
        })
      }
      e(".dropdown-toggle").click(function () {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
          e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
      });
      e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
      });
      e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
      })
    });
  </script>
</html>