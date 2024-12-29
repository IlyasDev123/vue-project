<?php


namespace App\Utlities;


class Constants
{
    const USER_TYPE_TALENT = 1;
    const USER_TYPE_COMPANY = 2;
    const RECRUITER = 3;
    const ADMIN = 4;
    const SUPER_ADMIN = 0;
    const BLOCKED_USER = 1;

    // ******************** Portfolio Matches request status ******************

    const TALENT_SEND_REQUEST_TO_COMPANY = 1;
    const COMPANY_SEND_REQUEST_TO_TALENT = 2;
    const REFER_TO_EMPLOYER = 6;
    const REFER_TO_TALENT = 8;
    const BOTH_ACCEPTED_REQUEST  = 3;
    const TALENT_REJECT_REQUEST = 4;
    const COMPANY_REJECT_REQUEST = 5;
    const SENT_INTERVIEW_REQUEST = 7;
    const REFER_TO_BOTH = 9;

    // ******************** JOB STATUS ******************
    const JOB_STATUS = [
        "open" => 1,
        "closed" => 2,
        "published" => 3,
        "draft" => 4,
    ];

    // ******************** TALENT SEARCH JOB STATUS ******************
    const TALENT_SERACH_JOB = [
        "searching" => 1,
        "notSearching" => 0,

    ];

    // ******************** COMPANY HIRING FOR JOB STATUS ******************
    const COMPANY_HIRIRNG_FOR_JOB = [
        "interested" => 1,
        "notInterested" => 0,
    ];

    const INTERVIEW_REQUEST = [
        "company" => 1,
        "admin" => 2,
    ];

    // ********************** USER STATUS ******************

    const USER_STATUS = [
        'pending' => 0,
        'active' => 1,
        'deactive' => 2,
        'rejected' => 3
    ];

    // ********************** PREMIUM STATUS ******************

    const PREMIUM_STATUS = [
        'free' => 1,
        'premium' => 2,
        'pending' => 3
    ];
    // ********************** REFER TO COMPANY AND tALENT ******************
    const REFER_STATUS = [
        'company' => 1,
        'talent' => 2,
        'both' => 3,
    ];

    const IS_LONGER_INTEREST = [
        'interested' => 1,
        'notInterested' => 0
    ];

    const NOTIFICATION_TYPE = [
        'interviewRequest' => 1,
        'referRequest' => 2,
        'employerSentInterviewRequest' => 3,
        'talentAcceptInterviewRequest' => 4,
        'matchRequest' => 5,
        'fullAccessRequest' => 6,
    ];

    const NOTIFICATION_STATUS = [
        'sendAdminAndRecruiter' => 1,
        'employer' => 2,
        'talent' => 3,
        'admin' => 4,
        'recruiter' => 5,
    ];

    const MEDIA_STORAGE_PATH = [
        'postAttachment' => 'posts/attachment'
    ];

    const POST_PRIVACY_STATUS = [
        'onlyMe' => 1,
        'talentEmployers' => 2,
        'employersOnly' => 3,
    ];

    const NOTIFICATION_MESSAGES = [
        "refer" => 'Refer you',
    ];
}
