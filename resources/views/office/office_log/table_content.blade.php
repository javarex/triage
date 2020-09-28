@forelse($clients as $client)
    <tr>
        <td width="">{{ $client->client->first_name.' '.$client->client->last_name }}</td>
        <td>{{ $client->activity }}</td>
    
        <td>{{ $client->created_at->format('m/d/Y') }}</td>
        <td class="text-nowrap pr-1">
            @if( $client->approve == 0)
                <a  href="javascript:void(0)" id="approve" class="badge badge-primary approve" data-value="1" data-id="{{ $client->id }}">Accept</a>
                    <span class="text-secondary">|</span>
                <a href="javascript:void(0)" id="approve" class="badge badge-danger approve" data-value="2" data-id="{{ $client->id }}">Decline</a>
            @elseif($client->approve == 1)
                <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> Approve</span>
            @elseif($client->approve == 2)
                <span class="badge badge-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Declined</span>
            @endif
        </td>
    </tr>
@empty
    <span>No data available...</span>
@endforelse