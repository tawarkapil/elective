<label for="duration">Payment Details </label>
<table class="table table-striped">
     <tbody>
         <tr>
            <td>
                <ul>
                    <li>Program : {{ $program_name }}</li>
                    <li>Duration : {{ $duration }} Weeks</li>
                    <li>Total Members : {{ $members }} </li>
                </ul>
            </td>
             <td>{{ ViewsHelper::displayAmount($destination_payment) }}</td>
         </tr>

         @if(count($tours_name) > 0)
         <tr>
             <td>
                <ul>
                    <li>Tours : {{ implode(',', $tours_name) }}</li>
                </ul>
            </td>
             <td>{{ ViewsHelper::displayAmount($tours_payment) }}</td>
         </tr>
         @endif

         @if(count($events_name) > 0)
         <tr>
             <td>
                <ul>
                    <li>Events & Addons : {{ implode(',', $events_name) }}</li>
                </ul>
            </td>
             <td>{{ ViewsHelper::displayAmount($events_payment) }}</td>
         </tr>
         @endif
     </tbody>
     <tfoot>
        <tr>
             <th>Total Payable Amount</th>
             <th>{{ ViewsHelper::displayAmount($total_payment) }}</th>
         </tr>
     </tfoot>
</table>