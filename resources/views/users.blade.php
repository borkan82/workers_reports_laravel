@include('header')
<body>
<div class="main">

    <div class="headline" style="width:1300px;margin-top: 20px;">
        <div class="name" style="line-height: 60px;"> Worker List</div>
    </div>
    <div class="subHeadline" style="width:1300px;">
        <h4 style="margin-left:14px; margin-bottom: 10px; color: #405272; font-size: 16px!important">{{ $userData->fullname }} 
            , {{ $userData->position }}</h4></div>
    <div class="toolBar">
        <button class="search" onclick="document.location = 'performance.php?id={{ $userData->id }}';"
                style="width:200px;">Product performance
        </button>

        @if ($userData->role !== "S")
            <button class="newreport" onclick="document.location = 'writeReport.php?id={{ $userData->id }}';">NEW REPORT</button>
            <button class="search" onclick="document.location = 'viewReport.php?id={{ $userData->id }}';">MY REPORTS</button>
        @endif

        @if ($userData->role == "S")

            <button class="search" onclick="document.location = 'userStats.php?id={{ $userData->id }}';">User Statistics</button>
            
            <button class="search" onclick="document.location = 'userLogs.php?id={{ $userData->id }}';" >User Logs</button>
                
            <button class="search" onclick="document.location = 'taskStats.php?id={{ $userData->id }}';" >Type Stats</button>

            <div class="dropdown">
                
                <button class="dropbtn">&#9660; Settings</button>
                
                <div class="dropdown-content">
                    
                    <button class="search" onclick="document.location = 'addUser.php?id={{ $userData->id }}'" > Add new User </button>
                    <button class="search" onclick="document.location = 'pageTypes.php?id={{ $userData->id }}'" >Add Page Type</button>
                    
                    
                </div>
                
            </div>

        @endif

        @if ($userAdmin == 1)
            echo '<div class="subheading" style="height:38px;margin-top:10px; margin-bottom: 5px;"><span class="hours" style="font-size:30px;">VIEW ALL WORKERS</span></div>';
        @endif
    </div>
    <div class="dayTable">
        <table class="dayView compact">
            
        </table>

    </div>

    <div style="clear:both"></div>
    <div class="tableHolder"
         style="font-size:14px; margin-top:45px; margin-bottom: 20px; width:auto; text-align: center;">
        infomedia © 2015 - <i>Workers Performance</i>
    </div>
</div>
</body>
<script>


    $("title").html("Worker List | Reports Panel");
    
    $(".dayView").DataTable({
        
        paginate: false,
        sDom: ""
        
    });

    function makePayment(userId, e) {
        var r = confirm("Are you shure you want to mark hours as paid?");
        if (r == true) {
            var podaci = {action: "makePayment", id: userId};

            $.ajax({
                url: "includes/adapter.php",
                type: "POST",
                dataType: "JSON",
                data: podaci,
                async: true,
                success: function (data) {
                    if (data > 0) {
                        $(e).css('background-color', '#aaa');
                    } else {
                        showError("Error occured!");
                    }
                }
            });

        } else {
        }

    }

</script>
</html>