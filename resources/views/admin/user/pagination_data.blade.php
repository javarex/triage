
    @foreach($clients as $client)
        <tr>
            <td>{{$client['qrcode']}}</td>
            <td>{{ $client['name'] }}</td>
            <td width="20">{{$client['age']}}</td>
            <td width="30">{{$client['gender']}}</td>
            <td>
                <a href="#" id="client_view" data-toggle="modal" data-target="#edit_user" 
                data-client_id="{{ $client['id'] }}"
                data-firstName="{{ $client['first_name'] }}"
                data-middleName="{{ $client['middle_name'] }}"
                data-lastName="{{ $client['last_name'] }}"
                data-birthday="{{ $client['birthday'] }}"
                >
                    <i class="fas fa-edit    "></i>
                </a>
            </td>
        </tr>
    @endforeach

    
