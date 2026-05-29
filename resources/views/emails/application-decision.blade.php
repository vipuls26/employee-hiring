<div>
    <h2 style="margin-bottom: 16px;">Application Status Update</h2>

    <p>Hello {{ $application->employee_name }},</p>
    <p>
        Your application for <strong>{{ $application->job?->name }}</strong> has been
        <strong>{{ $action }}</strong> by {{ $stage }}.
    </p>
    <p>
        Current application status:
        <strong>{{ $application->overall_status }}</strong>
    </p>
    <p>
        Reviewed by:
        <strong>{{ $reviewerName }}</strong>
    </p>

    @if ($reason)
        <p>
            Reason:
            <strong>{{ $reason }}</strong>
        </p>
    @endif

    <p>Thank you for applying.</p>
</div>
