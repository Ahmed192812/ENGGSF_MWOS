
<!DOCTYPE html>
<html>
<head>
    <title>All Orders PDF</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<Style>
    .page-break {
    page-break-after: always;
}
.styled-table {
    
    text-align: center;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 100%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #112B3C;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
    background-color: #f3f3f3;

}

/* .styled-table tbody tr:nth-of-type(even) {
} */

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #112B3C;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: black;
}


</Style>
<body>
<div class="container-fluid header " style="height: 150px; ">
<table style="position: absolute; width: 100%; border: 3px; " >
    <tr >
        <td style="width: 50%;">
        <h5 class="logo text-bold text-black pt-3 col-6">
            MWOS
        </h5>
        <strong class="text-bold text-black pt-3 col-6">Date: 04/29/2022</strong>
        </td>  
        <td  style="width: 50%; padding-left: 100px;">
        <span class="text-black  text-center col-12" ><strong> email: </strong>MWOS@gmail.com</span><br> 
        <span class="text-black  text-center col-12"><strong>phone Number: </strong>+9665938483</span>   
        </td>
    </tr>
   
</table>
</div>
<hr>
<h3 style="text-align: center;"><span>All Orders</span></h3>
<table class="styled-table">
    <thead>
    <tr>
                  <th scope="col">#</th>
                  <th scope="col-4">name</th>
                  <th scope="col">quintets</th>
                  <th scope="col">price</th>
                  <th scope="col">status</th>
                </tr>
    </thead>
    <tbody>
                @foreach ($orders as $order)
                    <tr>
                    <td class="col text-center align-middle">1</td>
                        <td class="col text-center align-middle">{{ $order->name}}</td>
                        <td class="col text-center align-middle">{{ $order->quantity}}</th>                      
                        <td class="col text-center align-middle">{{ $order->price}}</td>
                        <td class="col text-center align-middle">
                        @if($order->status == "Pending")
                        <span class="badge bg-info text-dark">{{ $order->status}} Payment/Material</span>
                        @elseif($order->status == "TBR")
                        <span class="badge bg-warning text-dark">To Be Reviewed</span>
                        @elseif($order->status == "Accepted")
                        <span class="badge bg-light text-dark">{{ $order->status}}</span>
                        @elseif($order->status == "Declined")
                        <span class="badge bg-danger text-dark">{{ $order->status}}</span>
                        @elseif($order->status == "processing")
                        <span class="badge bg-dark text-light">{{ $order->status}}</span>
                        @elseif($order->status == "done")
                        <span class="badge bg-success text-light">for Delivery /pek up</span>
                        <span class="badge bg-success text-light">Competed</span>
                        @endif
                        </td>
                    </tr>
                            @endforeach
                            
                            <tr>
                  <th scope="col">sum</th>
                  <th scope="col-4"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Total of Orders Price</th>
                </tr>
                            <tr>
                                <td>
                                    <strong>Sum:</strong>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    {{$sumOrderPrice}}
                                </td>
                            </tr>
                            
                   
                        
                </tbody>
</table>
<div class="page-break"></div>

<h3 style="text-align: center;"><span>All Custom Orders</span></h3>

<table class="styled-table">
    <thead>
    <tr>
                  <th scope="col">#</th>
                  <th scope="col-4">name</th>
                  <th scope="col">quintets</th>
                  <th scope="col">price</th>
                  <th scope="col">status</th>
                </tr>
    </thead>
    <tbody>
              
                            @foreach ($customs as $custom)
                    <tr>
                    <td class="col text-center align-middle">1</td>
                        <td class="col text-center align-middle">A Custom {{ $custom->prodCategory}}</td>
                        <td class="col text-center align-middle">{{ $custom->quantity}}</th>                      
                        <td class="col text-center align-middle">@if($custom->price == null) price not yet here  @else{{ $custom->price }} @endif</td>
                        <td class="col text-center align-middle">
                        @if($custom->status == "Pending")
                        <span class="badge bg-info text-dark">{{ $custom->status}} Payment/Material</span>
                        @elseif($custom->status == "TBR")
                        <span class="badge bg-warning text-dark">To Be Reviewed</span>
                        @elseif($custom->status == "Accepted")
                        <span class="badge bg-light text-dark">{{ $custom->status}}</span>
                        @elseif($custom->status == "Declined")
                        <span class="badge bg-danger text-dark">{{ $custom->status}}</span>
                        @elseif($custom->status == "processing")
                        <span class="badge bg-dark text-light">{{ $custom->status}}</span>
                        @elseif($custom->status == "done")
                        <span class="badge bg-success text-light">for Delivery /pek up</span>
                        <span class="badge bg-success text-light">Competed</span>
                        @endif
                        </td>

                     
                    </tr>
                  
                            @endforeach
                            
                            <tr>
                  <th scope="col">sum</th>
                  <th scope="col-4"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Total of Custom Orders Price</th>
                </tr>
                            <tr>
                                <td>
                                    <strong>Sum:</strong>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    {{$sumCustomPrice}}
                                </td>
                            </tr>
                          

                   
                        
                </tbody>
</table>
<div class="page-break"></div>

<h3 style="text-align: center;"><span>All Repair Orders</span></h3>

<table class="styled-table">
    <thead>
    <tr>
                  <th scope="col">#</th>
                  <th scope="col-4">name</th>
                  <th scope="col">quintets</th>
                  <th scope="col">price</th>
                  <th scope="col">status</th>
                </tr>
    </thead>
    <tbody>
              
    @foreach ($repairs as $repair)
                    <tr>
                    <td class="col text-center align-middle">1</td>
                        <td class="col text-center align-middle">repair a {{ $repair->prodCategory}}</td>
                        <td class="col text-center align-middle">{{ $repair->quantity}}</th>                      
                        <td class="col text-center align-middle">
                        @if($repair->estimatedPrice == null && $repair->actualPrice == null) 
                            price not yet here 
                        @elseif($repair->estimatedPrice !== null && $repair->actualPrice == null )
                            estimated price({{ $repair->estimatedPrice }}) 
                        @elseif($repair->estimatedPrice !== null && $repair->actualPrice !== null )
                            {{ $repair->actualPrice }}
                         @else {{ $repair->actualPrice }} @endif
                    </td>
                        <td class="col text-center align-middle">
                        @if($repair->status == "Pending")
                        <span class="badge bg-info text-dark">{{ $repair->status}} Payment/Material</span>
                        @elseif($repair->status == "TBR")
                        <span class="badge bg-warning text-dark">To Be Reviewed</span>
                        @elseif($repair->status == "Accepted")
                        <span class="badge bg-light text-dark">{{ $repair->status}}</span>
                        @elseif($repair->status == "Declined")
                        <span class="badge bg-danger text-dark">{{ $repair->status}}</span>
                        @elseif($repair->status == "processing")
                        <span class="badge bg-dark text-light">{{ $repair->status}}</span>
                        @elseif($repair->status == "done")
                        <span class="badge bg-success text-light">for Delivery /pek up</span>
                        <span class="badge bg-success text-light">Competed</span>
                        @endif
                        </td>
                    </tr>
                    
                    @endforeach

                    <br>
                            <tr>
                  <th scope="col">sum</th>
                  <th scope="col-4"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Total of Repair orders Price</th>
                </tr>
                            <tr>
                                <td>
                                    <strong>Sum:</strong>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    {{$sumRepairPrice}}
                                </td>
                            </tr>
                          

                   
                        
                </tbody>
</table>



</body>
</html>