const apiDataArray = [
    {
        //Momo
        "momoMsg": {
            "begin": null,
            "end": null,
            "tranList": [
                {
                    "momoMsg": {
                        "begin": null,
                        "end": null,
                        "tranList": [
                            {
                                "ID": "null",
                                "user": "null",
                                "commandInd": "null",
                                "tranId": null,
                                "clientTime": null,
                                "ackTime": null,
                                "finishTime": null,
                                "tranType": null,
                                "io": -1,
                                "partnerId": "null",
                                "partnerCode": "null",
                                "partnerName": "null",
                                "amount": null,
                                "comment": "null.",
                                "status": 2,
                                "ownerNumber": "0982933507",
                                "ownerName": "nguyen trong vy",
                                "moneySource": 1,
                                "desc": "Thành công",
                                "serviceMode": "transfer_p2p",
                                "originalAmount": 30000.0,
                                "serviceId": "transfer_p2p",
                                "quantity": 1,
                                "lastUpdate": 1.616909085354E12,
                                "share": "0.0",
                                "receiverType": 1,
                                "extras": "null",
                                "channel": "END_USER",
                                "otpType": "NA",
                                "ipAddress": "null",
                                "_class": "null"
                            }
                        ],
                        "_class": "null"
                    },
                    "time": null,
                    "user": "null",
                    "pass": "null",
                    "cmdId": "null",
                    "lang": "vi",
                    "msgType": "QUERY_TRAN_HIS_MSG",
                    "result": true,
                    "appCode": "2.1.53",
                    "appVer": 21530,
                    "channel": "APP",
                    "deviceOS": "null",
                    "ip": "null",
                    "path": "null",
                    "localAddress": "null",
                    "session": "nosessionid",
                    "extra": {
                        "originalClass": "mservice.backend.entity.msg.QueryTranhisMsg",
                        "originalPhone": "null",
                        "checkSum": "null"
                    }
                }
            ]
        }
    },
    //Vietcombank
    {
        "status": true,
        "data": {
            "ChiTietGiaoDich": [
                {
                    "SoThamChieu": "5088 - 96951",
                    "SoTienGhiCo": "314,000",
                    "MoTa": "Ecom.EW21052476367476.MOMO.0868698542.CashIn",
                    "NgayGiaoDich": "24/05/2021",
                    "CD": "-"
                },
                {
                    "SoThamChieu": "5017 - 03365",
                    "SoTienGhiCo": "315,000",
                    "MoTa": "140297.240521.131928.Bbbb FT21144277542952",
                    "NgayGiaoDich": "24/05/2021",
                    "CD": "+"
                }
            ]
        }
    },
    //BIDV
    {
        "status": true,
        "data": {
          "ChiTietGiaoDich": [
            {
              "SoThamChieu": "000cEOM-7nmZE7xHI",
              "SoTienGhiCo": "1",
              "MoTa": "Thanh toan lai thang 12/2023",
              "NgayGiaoDich": "28/12/2023",
              "CD": "+"
            }
          ]
                }
    },
    //Techcombank
    {
        "success": true,
        "transactions": [
            {
                "CD": "+",
                "Reference": "FT21154716080906\\BNK",
                "TransID": "FT21154716080906\\BNK",
                "Amount": "11,111",
                "Description": "naptien 1",
                "TransactionDate": "03/06/2021",
                "TransactionDateUnix": 1622653200000,
                "TransactionDateFull": "03/06/2021 00:00:00",
                "PCTime": "1622653200000",
                "CurrentBalance": 3318675
            },
            {
                "CD": "+",
                "Reference": "FT21154896500605\\BNK",
                "TransID": "FT21154896500605\\BNK",
                "Amount": "150,000",
                "Description": "naptien 177",
                "TransactionDate": "03/06/2021",
                "TransactionDateUnix": 1622653200000,
                "TransactionDateFull": "03/06/2021 00:00:00",
                "PCTime": "1622653200000",
                "CurrentBalance": 3307564
            },
        ]
    },
    //Seabank
    {
        "code": "00",
        "message": "Success",
        "messageVi": null,
        "messageEn": null,
        "data": [
            {
                "stmtID": "205947106173815.040001",
                "transID": "FT24141308982445",
                "transTypeID": "inward",
                "transTypeEn": "inward",
                "transTypeVn": "inward",
                "creditAccount": "000006238327",
                "recipientID": "17492033",
                "recipient": "NGUYEN TRONG VY",
                "receivingBankCode": "VN0010126",
                "receivingBank": "SeABank",
                "debitAccount": "737478888",
                "customerID": null,
                "customerName": "Chu so tai khoan/so the 737478888",
                "sendingBankCode": "970416",
                "sendingBank": "ACB-NH TMCP A CHAU",
                "totalAmount": "2000",
                "ccy": "VND",
                "totalLocalAmount": "2000",
                "feeAmount": null,
                "ccyFee": null,
                "localAmount": null,
                "transactionDate": "19/05/2024",
                "valueDate": "20/05/2024",
                "description": "TEST19052420.30.12 681880 . . .  . Nguoi chuyen: 737478888",
                "dateTime": "20240519203000",
                "ngTranType": "inward",
                "feeAmountLcy": null
            }
        ]
    },
    //ACB
    {
        "success": true,
        "message": "Success",
        "took": 37,
        "transactions": [
            {
                "amount": 10000,
                "accountName": "TGTT KHTN (CA NHAN) VND",
                "receiverName": null,
                "transactionNumber": 4601,
                "description": "NAP TIEN VAO VI MOMO 0902506099",
                "bankName": null,
                "isOnline": false,
                "postingDate": 1617382800000,
                "accountOwner": null,
                "type": "OUT",
                "receiverAccountNumber": "",
                "currency": "VND",
                "account": 222629219,
                "activeDatetime": 1617367539000,
                "effectiveDate": 1617382800000
            },
            {
                "amount": 550000,
                "accountName": "TGTT KHTN (CA NHAN) VND",
                "receiverName": null,
                "transactionNumber": 4600,
                "description": "NAP TIEN VAO VI MOMO 0902506099",
                "bankName": null,
                "isOnline": false,
                "postingDate": 1617296400000,
                "accountOwner": null,
                "type": "OUT",
                "receiverAccountNumber": "",
                "currency": "VND",
                "account": 222629219,
                "activeDatetime": 1617359728000,
                "effectiveDate": 1617296400000
            },
            {
                "amount": 2000000,
                "accountName": "TGTT KHTN (CA NHAN) VND",
                "receiverName": "NGUYEN TRONG VY",
                "transactionNumber": 4599,
                "description": "IB NGO QUOC MINH KY MK",
                "bankName": "ACB - NH TMCP A CHAU",
                "isOnline": false,
                "postingDate": 1617296400000,
                "accountOwner": null,
                "type": "IN",
                "receiverAccountNumber": "",
                "currency": "VND",
                "account": 222629219,
                "activeDatetime": 1617357788000,
                "effectiveDate": 1617296400000
            },
            {
                "amount": 10000,
                "accountName": "TGTT KHTN (CA NHAN) VND",
                "receiverName": null,
                "transactionNumber": 4598,
                "description": "THU PHI DICH VU CHUYEN TIEN NHANH-020421-13:28:27 571202",
                "bankName": null,
                "isOnline": false,
                "postingDate": 1617296400000,
                "accountOwner": "NGUYEN THANH TAN",
                "type": "OUT",
                "receiverAccountNumber": "",
                "currency": "VND",
                "account": 222629219,
                "activeDatetime": 1617344930000,
                "effectiveDate": 1617296400000
            }
        ],
        "total": 7,
        "page": 1,
        "size": 100
    },
    //MB Bank
    {
        "success": true,
        "message": "Thành công",
        "data": [
            {
                "postingDate": "03/06/2021 19:02:00",
                "transactionDate": "03/06/2021 19:02:00",
                "accountNo": "0868698542",
                "creditAmount": "10000",
                "debitAmount": "0",
                "currency": "VND",
                "description": "TEST 030621 19 02 17 692793 - Ma gi ao dich/ Trace 692793",
                "availableBalance": "10000",
                "beneficiaryAccount": null,
                "refNo": "FT21154769354320\\BNK",
                "benAccountName": null,
                "bankName": null,
                "benAccountNo": null
            }
        ]
    },
    //TP Bank
    {
        "transactionInfos": [
            {
                "id": "5302192349",
                "arrangementId": "04310682788,VND-1633866575374-a0f4ab7158136817106c092f0098eea8edc508cb6aa598f2056762d586b82f29",
                "reference": "666V009212814077",
                "description": "Chuyen",
                "bookingDate": "2021-10-08",
                "valueDate": "2021-10-08",
                "amount": "10000",
                "currency": "VND",
                "creditDebitIndicator": "DBIT", // Chuyển tiền
                "runningBalance": "0"
            },
            {
                "id": "5302184818",
                "arrangementId": "04310682788,VND-1633866575375-31cb5b18f793dd0a3da06826d7c7839793dcff191876a042978bc0b6c41f62eb",
                "reference": "666ITC1212813111",
                "description": "Test",
                "bookingDate": "2021-10-08",
                "valueDate": "2021-10-08",
                "amount": "10000",
                "currency": "VND",
                "creditDebitIndicator": "CRDT", // Nhận tiền
                "runningBalance": "10000"
            }
        ],
        "error": false,
        "total": 2
    },
    //Viettinbank
    {
        "requestId": "QRL3GLIVQ48X|1695015935446",
        "sessionId": "R6UE6ZCBQW",
        "error": false,
        "accountNo": "107870171052",
        "currentPage": 0,
        "nextPage": 0,
        "pageSize": 100,
        "totalRecords": 1,
        "warningMsg": "",
        "transactions": [
            {
                "currency": "VND",
                "remark": "CT DEN:326016308274 TEST-170923-16:04:46 308274",
                "amount": "10000.00",
                "balance": "10000.00",
                "trxId": "289S2390SY10VM40",
                "processDate": "17-09-2023 16:04:47",
                "dorC": "C",
                "refType": "HistoryRecordSequence",
                "refId": "238",
                "tellerId": "1000819",
                "corresponsiveAccount": "737478888",
                "corresponsiveName": "NGUYEN TRONG VY",
                "channel": "28 - Transware (TWO) Switch via Banknet VPG (VTB Payment Gateway)",
                "serviceBranchId": "28998",
                "serviceBranchName": "CN KCN QUE VO - HOI SO",
                "pmtType": "RTGSIN - Chuyển tiền nhanh",
                "sendingBankId": "970416",
                "sendingBranchId": "",
                "sendingBranchName": "ACB_NH TMCP A Chau",
                "receivingBankId": "",
                "receivingBranchId": "",
                "receivingBranchName": ""
            }
        ],
        "success": true
    },
    //Zalo Pay
    {
        "status": true,
        "message": "Thành công",
        "code": 200,
        "data": [
            {
                "userid": "180801000002986",
                "transid": 211219001064228,
                "appid": 450,
                "appuser": "210707001003797",
                "platform": "android",
                "description": "571",
                "pmcid": 38,
                "reqdate": 1639900433098,
                "userchargeamt": 1000,
                "amount": 1000,
                "userfeeamt": 0,
                "type": 4,
                "sign": 1,
                "username": "Trong Vy",
                "appusername": "",
                "transstatus": 1,
                "isretry": false,
                "isrefundsucc": 0,
                "discountamount": 0,
                "item": "{\"transtype\":4,\"ext\":\"Người nhận:Trong Vy\\tSố điện thoại:*** 6099\",\"sender\":{\"phonenumber\":\"098 2829264\",\"name\":\"Tiến Lê\",\"userid\":\"210707001003797\"}}",
                "tpebankcode": "",
                "first6char": "",
                "last4char": "",
                "apptransid": "211219000311739"
            }
        ]
    }
]

function syntaxHighlight(json) {
    if (typeof json != 'string') {
        json = JSON.stringify(json, undefined, 2);
    }
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'num';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

// Tìm tất cả các phần tử có class "json-display"
document.addEventListener('DOMContentLoaded', function() {
    const jsonDisplays = document.querySelectorAll('.json-display');

    // Lặp qua từng phần tử và chèn dữ liệu JSON tương ứng
    jsonDisplays.forEach(function(display, index) {
        // Sử dụng dữ liệu từ apiDataArray tương ứng với chỉ số
        if (apiDataArray[index]) {
            display.innerHTML = syntaxHighlight(apiDataArray[index]);
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var apiTitles = document.querySelectorAll('.api-title');

    apiTitles.forEach(function(title) {
        title.addEventListener('click', function() {
            var apiContent = this.nextElementSibling;

            // Kiểm tra và thêm/xóa lớp 'open'
            if (apiContent.classList.contains('open')) {
                apiContent.classList.remove('open');
            } else {
                // Ẩn các phần tử khác đang mở
                document.querySelectorAll('.api-content.open').forEach(function(content) {
                    content.classList.remove('open');
                });

                apiContent.classList.add('open');
            }
        });
    });

    // Ẩn tất cả các phần tử .api-content khi trang được tải
    var apiContents = document.querySelectorAll('.api-content');
    apiContents.forEach(function(content) {
        content.classList.remove('open');
    });
});







