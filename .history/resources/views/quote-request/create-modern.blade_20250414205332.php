<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Ujian - Modul 8: ARP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles if needed */
        body {
            font-family: 'Inter', sans-serif; /* Use Inter font */
        }
        /* Style for correct/incorrect feedback (optional, can be added later) */
        .correct { background-color: #d1fae5; } /* Green-100 */
        .incorrect { background-color: #fee2e2; } /* Red-100 */
        .question-block {
            border: 1px solid #e5e7eb; /* Gray-200 */
            border-radius: 0.5rem; /* rounded-lg */
            padding: 1rem; /* p-4 */
            margin-bottom: 1rem; /* mb-4 */
            background-color: white;
        }
        .question-text {
            font-weight: 600; /* font-semibold */
            margin-bottom: 0.75rem; /* mb-3 */
        }
        .option-label {
            display: block;
            margin-bottom: 0.5rem; /* mb-2 */
            padding: 0.5rem;
            border-radius: 0.375rem; /* rounded-md */
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .option-label:hover {
            background-color: #f3f4f6; /* Gray-100 */
        }
        input[type="radio"], input[type="checkbox"] {
            margin-right: 0.5rem; /* mr-2 */
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4 md:p-8">

    <div class="max-w-3xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Simulasi Ujian - Modul 8: ARP</h1>
        <p class="mb-6 text-gray-600 text-center">Pilih jawaban yang paling tepat. Untuk soal dengan keterangan "(lebih dari satu jawaban)", pilih semua jawaban yang benar.</p>

        <form id="quiz-form">

            <div class="question-block">
                <p class="question-text">1. Sebuah workstation Linux (Host A) ingin mengirimkan paket ke server file (Host B) yang berada dalam satu subnet IP yang sama. Host A mengetahui alamat IP Host B, namun belum pernah berkomunikasi sebelumnya. Protokol apa yang akan digunakan Host A *pertama kali* untuk dapat mengirimkan frame Ethernet ke Host B?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q1" value="a" id="q1a"> a. DNS (Domain Name System)</label>
                    <label class="option-label"><input type="radio" name="q1" value="b" id="q1b"> b. DHCP (Dynamic Host Configuration Protocol)</label>
                    <label class="option-label"><input type="radio" name="q1" value="c" id="q1c"> c. ARP (Address Resolution Protocol)</label>
                    <label class="option-label"><input type="radio" name="q1" value="d" id="q1d"> d. ICMP (Internet Control Message Protocol)</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">2. Manakah pernyataan yang paling akurat mendeskripsikan peran alamat IP dan alamat MAC ketika sebuah host mengirimkan data ke host lain yang berada di **jaringan remote**?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q2" value="a" id="q2a"> a. IP Sumber & IP Tujuan tetap, MAC Sumber & MAC Tujuan tetap selama perjalanan antar jaringan.</label>
                    <label class="option-label"><input type="radio" name="q2" value="b" id="q2b"> b. IP Sumber & IP Tujuan tetap, MAC Sumber & MAC Tujuan berubah di setiap hop (segmen jaringan).</label>
                    <label class="option-label"><input type="radio" name="q2" value="c" id="q2c"> c. IP Sumber & IP Tujuan berubah di setiap hop, MAC Sumber & MAC Tujuan tetap.</label>
                    <label class="option-label"><input type="radio" name="q2" value="d" id="q2d"> d. IP Sumber tetap, IP Tujuan menjadi IP gateway, MAC Sumber & MAC Tujuan berubah di setiap hop.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">3. Seorang pengguna di Windows menjalankan perintah `arp -a` dan melihat entri berikut:
                <pre class="bg-gray-100 p-2 rounded text-sm my-2">Interface: 192.168.1.100 --- 0x15
  Internet Address      Physical Address      Type
  192.168.1.1           00-1a-2b-3c-4d-5e     dynamic
  192.168.1.254         a0-b1-c2-d3-e4-f5     dynamic</pre>
                Apa arti dari informasi ini?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q3" value="a" id="q3a"> a. Host 192.168.1.100 memiliki MAC address 00-1a-2b-3c-4d-5e.</label>
                    <label class="option-label"><input type="radio" name="q3" value="b" id="q3b"> b. Host 192.168.1.100 mengetahui bahwa host dengan IP 192.168.1.1 memiliki MAC address 00-1a-2b-3c-4d-5e.</label>
                    <label class="option-label"><input type="radio" name="q3" value="c" id="q3c"> c. Ini adalah tabel routing statis yang dikonfigurasi pada host.</label>
                    <label class="option-label"><input type="radio" name="q3" value="d" id="q3d"> d. Perintah `arp -a` digunakan untuk menetapkan alamat IP statis ke host.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">4. Bagaimana mekanisme utama sebuah serangan *ARP Spoofing* atau *ARP Poisoning* dapat memungkinkan penyerang melakukan Man-in-the-Middle (MitM) attack?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q4" value="a" id="q4a"> a. Penyerang mengirimkan ARP Request ke semua host, meminta mereka mengupdate ARP table dengan MAC address penyerang.</label>
                    <label class="option-label"><input type="radio" name="q4" value="b" id="q4b"> b. Penyerang membanjiri switch dengan frame Ethernet palsu sehingga switch bertindak seperti hub.</label>
                    <label class="option-label"><input type="radio" name="q4" value="c" id="q4c"> c. Penyerang mengirimkan ARP Reply palsu (unsolicited atau sebagai balasan) ke host target (mis: korban), mengasosiasikan IP address host lain (mis: gateway) dengan MAC address milik penyerang.</label>
                    <label class="option-label"><input type="radio" name="q4" value="d" id="q4d"> d. Penyerang mengubah entri DNS pada server DNS lokal untuk mengarahkan trafik ke IP penyerang.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">5. Perhatikan proses ARP. Manakah pernyataan yang benar mengenai pesan ARP Request dan ARP Reply?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q5" value="a" id="q5a"> a. ARP Request dikirim sebagai unicast, ARP Reply dikirim sebagai broadcast.</label>
                    <label class="option-label"><input type="radio" name="q5" value="b" id="q5b"> b. Baik ARP Request maupun ARP Reply dikirim sebagai broadcast.</label>
                    <label class="option-label"><input type="radio" name="q5" value="c" id="q5c"> c. ARP Request dikirim sebagai broadcast, ARP Reply dikirim sebagai unicast.</label>
                    <label class="option-label"><input type="radio" name="q5" value="d" id="q5d"> d. Baik ARP Request maupun ARP Reply dikirim sebagai unicast.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">6. Komputer A (IP: 192.168.10.5 / MAC: AA:AA:AA:AA:AA:AA) ingin berkomunikasi dengan Server B (IP: 172.16.20.10). Default gateway untuk Komputer A adalah Router R1 (IP: 192.168.10.1 / MAC: BB:BB:BB:BB:BB:BB). Saat Komputer A mengirimkan frame pertama ke Server B, alamat MAC tujuan yang akan digunakan dalam header Ethernet frame tersebut adalah:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q6" value="a" id="q6a"> a. AA:AA:AA:AA:AA:AA</label>
                    <label class="option-label"><input type="radio" name="q6" value="b" id="q6b"> b. BB:BB:BB:BB:BB:BB</label>
                    <label class="option-label"><input type="radio" name="q6" value="c" id="q6c"> c. Alamat MAC Server B (yang belum diketahui A)</label>
                    <label class="option-label"><input type="radio" name="q6" value="d" id="q6d"> d. FF:FF:FF:FF:FF:FF (Broadcast)</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">7. Apa saja potensi masalah yang dapat timbul akibat sifat broadcast dari pesan ARP Request dalam jaringan yang besar atau sibuk? (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q7[]" value="a" id="q7a"> a. Setiap host di jaringan lokal harus menerima dan memproses setiap ARP Request.</label>
                    <label class="option-label"><input type="checkbox" name="q7[]" value="b" id="q7b"> b. Pesan ARP Request dapat dengan mudah melewati router ke jaringan lain.</label>
                    <label class="option-label"><input type="checkbox" name="q7[]" value="c" id="q7c"> c. Dapat menyebabkan penurunan kinerja jaringan sesaat jika banyak request terjadi bersamaan.</label>
                    <label class="option-label"><input type="checkbox" name="q7[]" value="d" id="q7d"> d. Memerlukan konfigurasi manual ARP table di setiap host.</label>
                </div>
            </div>

             <div class="question-block">
                <p class="question-text">8. Dalam jaringan IPv6, mekanisme yang menyediakan fungsionalitas serupa dengan ARP untuk resolusi alamat link-local adalah:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q8" value="a" id="q8a"> a. ARPv6</label>
                    <label class="option-label"><input type="radio" name="q8" value="b" id="q8b"> b. DHCPv6 Address Allocation</label>
                    <label class="option-label"><input type="radio" name="q8" value="c" id="q8c"> c. ICMPv6 Neighbor Discovery (ND)</label>
                    <label class="option-label"><input type="radio" name="q8" value="d" id="q8d"> d. IPv6 Router Advertisement (RA)</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">9. Entri dinamis dalam tabel ARP sebuah host dapat dihapus melalui mekanisme berikut: (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q9[]" value="a" id="q9a"> a. Berakhirnya masa berlaku timer (cache timeout).</label>
                    <label class="option-label"><input type="checkbox" name="q9[]" value="b" id="q9b"> b. Perintah manual yang dijalankan oleh administrator.</label>
                    <label class="option-label"><input type="checkbox" name="q9[]" value="c" id="q9c"> c. Setiap kali host menerima ARP Request baru.</label>
                    <label class="option-label"><input type="checkbox" name="q9[]" value="d" id="q9d"> d. Ketika host menerima paket DHCP Offer.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">10. Pada lapisan mana dalam model OSI proses resolusi alamat menggunakan ARP terjadi, dan alamat apa yang ditambahkan ke PDU (Protocol Data Unit) sebagai hasil dari proses ARP yang berhasil untuk pengiriman frame?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q10" value="a" id="q10a"> a. Lapisan Network; Alamat IP Sumber dan Tujuan</label>
                    <label class="option-label"><input type="radio" name="q10" value="b" id="q10b"> b. Lapisan Data Link; Alamat MAC Sumber dan Tujuan</label>
                    <label class="option-label"><input type="radio" name="q10" value="c" id="q10c"> c. Lapisan Transport; Nomor Port Sumber dan Tujuan</label>
                    <label class="option-label"><input type="radio" name="q10" value="d" id="q10d"> d. Lapisan Network; Alamat MAC Default Gateway</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">11. Sebuah entri dinamis dalam ARP table pada sebuah host umumnya berisi pemetaan antara:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q11" value="a" id="q11a"> a. Alamat IP host tersebut dengan alamat MAC host tersebut.</label>
                    <label class="option-label"><input type="radio" name="q11" value="b" id="q11b"> b. Alamat IP host *lain* di jaringan lokal dengan alamat MAC host *tersebut*.</label>
                    <label class="option-label"><input type="radio" name="q11" value="c" id="q11c"> c. Nama domain host lain dengan alamat IP host tersebut.</label>
                    <label class="option-label"><input type="radio" name="q11" value="d" id="q11d"> d. Alamat IP jaringan remote dengan alamat MAC default gateway.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">12. Sebuah host pada jaringan Ethernet hanya akan mengirimkan ARP Reply ketika:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q12" value="a" id="q12a"> a. Host tersebut menerima ARP Reply dari host lain.</label>
                    <label class="option-label"><input type="radio" name="q12" value="b" id="q12b"> b. Host tersebut menerima ARP Request yang menanyakan alamat MAC untuk *alamat IP yang dimiliki oleh host tersebut*.</label>
                    <label class="option-label"><input type="radio" name="q12" value="c" id="q12c"> c. Host tersebut perlu mengetahui alamat MAC dari default gateway.</label>
                    <label class="option-label"><input type="radio" name="q12" value="d" id="q12d"> d. Host tersebut baru saja bergabung ke dalam jaringan.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">13. Seorang network administrator sedang troubleshooting pada sebuah router Cisco dan perlu melihat tabel pemetaan alamat IP ke MAC yang diketahui oleh router tersebut. Perintah Cisco IOS manakah yang digunakan untuk tujuan ini?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q13" value="a" id="q13a"> a. `show mac address-table`</label>
                    <label class="option-label"><input type="radio" name="q13" value="b" id="q13b"> b. `show ip interface brief`</label>
                    <label class="option-label"><input type="radio" name="q13" value="c" id="q13c"> c. `show running-config`</label>
                    <label class="option-label"><input type="radio" name="q13" value="d" id="q13d"> d. `show ip arp`</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">14. Dalam banyak serangan Man-in-the-Middle menggunakan ARP spoofing, mengapa penyerang seringkali memalsukan ARP Reply untuk alamat IP *default gateway* dan mengirimkannya ke host korban?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q14" value="a" id="q14a"> a. Karena default gateway adalah satu-satunya perangkat yang memiliki ARP table.</label>
                    <label class="option-label"><input type="radio" name="q14" value="b" id="q14b"> b. Untuk mengalihkan semua trafik korban yang ditujukan ke *luar jaringan lokal* agar melewati perangkat penyerang terlebih dahulu.</label>
                    <label class="option-label"><input type="radio" name="q14" value="c" id="q14c"> c. Agar default gateway mengirimkan semua trafiknya ke penyerang.</label>
                    <label class="option-label"><input type="radio" name="q14" value="d" id="q14d"> d. Karena MAC address default gateway paling mudah ditebak oleh penyerang.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">15. Dalam komunikasi data melalui jaringan IP: (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q15[]" value="a" id="q15a"> a. Alamat MAC tujuan digunakan untuk mengidentifikasi host tujuan akhir di jaringan manapun.</label>
                    <label class="option-label"><input type="checkbox" name="q15[]" value="b" id="q15b"> b. Alamat IP tujuan digunakan untuk pengiriman frame data antar NIC dalam satu segmen LAN.</label>
                    <label class="option-label"><input type="checkbox" name="q15[]" value="c" id="q15c"> c. Alamat IP tujuan mengidentifikasi host tujuan akhir secara global (atau di internetwork).</label>
                    <label class="option-label"><input type="checkbox" name="q15[]" value="d" id="q15d"> d. Alamat MAC tujuan mengidentifikasi NIC tujuan pada segmen jaringan lokal saat ini (hop berikutnya).</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">16. Apa tujuan utama dari adanya mekanisme cache timeout (timer) untuk entri dinamis dalam ARP table?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q16" value="a" id="q16a"> a. Untuk menghemat memori pada perangkat host atau router.</label>
                    <label class="option-label"><input type="radio" name="q16" value="b" id="q16b"> b. Untuk memastikan bahwa pemetaan IP ke MAC tetap akurat jika ada perubahan perangkat atau alamat di jaringan.</label>
                    <label class="option-label"><input type="radio" name="q16" value="c" id="q16c"> c. Untuk mencegah serangan ARP spoofing secara otomatis.</label>
                    <label class="option-label"><input type="radio" name="q16" value="d" id="q16d"> d. Untuk memaksa perangkat menggunakan broadcast lebih sering agar jaringan tetap aktif.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">17. Komputer A (192.168.1.10) ingin mengirim data ke Komputer B (192.168.1.20) yang berada di subnet yang sama. Komputer A *sudah memiliki* entri untuk 192.168.1.20 di ARP cache-nya. Tindakan apa yang akan dilakukan Komputer A?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q17" value="a" id="q17a"> a. Mengirimkan ARP Request lagi untuk memastikan entri masih valid.</label>
                    <label class="option-label"><input type="radio" name="q17" value="b" id="q17b"> b. Mengirimkan frame Ethernet langsung ke alamat MAC Komputer B sesuai entri di cache.</label>
                    <label class="option-label"><input type="radio" name="q17" value="c" id="q17c"> c. Mengirimkan frame Ethernet ke alamat MAC default gateway.</label>
                    <label class="option-label"><input type="radio" name="q17" value="d" id="q17d"> d. Menunggu ARP Request dari Komputer B terlebih dahulu.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">18. Fitur keamanan pada switch Cisco yang dapat membantu memitigasi serangan ARP spoofing dengan memvalidasi paket ARP pada jaringan adalah:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q18" value="a" id="q18a"> a. Port Security</label>
                    <label class="option-label"><input type="radio" name="q18" value="b" id="q18b"> b. VLAN ACLs (VACLs)</label>
                    <label class="option-label"><input type="radio" name="q18" value="c" id="q18c"> c. DHCP Snooping</label>
                    <label class="option-label"><input type="radio" name="q18" value="d" id="q18d"> d. Dynamic ARP Inspection (DAI)</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">19. Dalam protokol Neighbor Discovery (ND) di IPv6, pesan ICMPv6 mana yang berfungsi mirip dengan ARP Request dan ARP Reply di IPv4? (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q19[]" value="a" id="q19a"> a. Router Solicitation (RS)</label>
                    <label class="option-label"><input type="checkbox" name="q19[]" value="b" id="q19b"> b. Neighbor Solicitation (NS)</label>
                    <label class="option-label"><input type="checkbox" name="q19[]" value="c" id="q19c"> c. Router Advertisement (RA)</label>
                    <label class="option-label"><input type="checkbox" name="q19[]" value="d" id="q19d"> d. Neighbor Advertisement (NA)</label>
                </div>
            </div>

            <div class="question-block">
                 <p class="question-text">20. Sebuah host dikonfigurasi dengan alamat IP, subnet mask, dan default gateway yang benar. Host tersebut dapat melakukan ping ke host lain di jaringan lokalnya, tetapi tidak dapat melakukan ping ke alamat IP di internet (misalnya 8.8.8.8). Jika `arp -a` *tidak* menunjukkan entri untuk alamat IP default gateway, kemungkinan penyebab masalah yang paling berkaitan langsung dengan ARP adalah:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q20" value="a" id="q20a"> a. Kegagalan proses ARP untuk menemukan MAC address default gateway.</label>
                    <label class="option-label"><input type="radio" name="q20" value="b" id="q20b"> b. Kabel jaringan ke default gateway terputus.</label>
                    <label class="option-label"><input type="radio" name="q20" value="c" id="q20c"> c. Konfigurasi DNS server salah pada host.</label>
                    <label class="option-label"><input type="radio" name="q20" value="d" id="q20d"> d. Firewall pada host memblokir trafik keluar.</label>
                </div>
            </div>

             <div class="question-block">
                <p class="question-text">21. Selain alamat MAC dan IP pengirim, informasi penting apa lagi yang *harus* ada dalam payload sebuah pesan ARP Request?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q21" value="a" id="q21a"> a. Alamat MAC host tujuan (target MAC address).</label>
                    <label class="option-label"><input type="radio" name="q21" value="b" id="q21b"> b. Alamat IP host tujuan (target IP address).</label>
                    <label class="option-label"><input type="radio" name="q21" value="c" id="q21c"> c. Nomor sequence untuk pesan ARP.</label>
                    <label class="option-label"><input type="radio" name="q21" value="d" id="q21d"> d. Alamat IP default gateway pengirim.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">22. Berbeda dengan entri ARP dinamis yang dipelajari secara otomatis, entri ARP statis: (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q22[]" value="a" id="q22a"> a. Tidak akan pernah dihapus dari ARP table kecuali dihapus manual oleh administrator.</label>
                    <label class="option-label"><input type="checkbox" name="q22[]" value="b" id="q22b"> b. Biasanya digunakan untuk memetakan alamat broadcast atau multicast pada beberapa sistem.</label>
                    <label class="option-label"><input type="checkbox" name="q22[]" value="c" id="q22c"> c. Dibuat secara otomatis setiap kali host melakukan booting.</label>
                    <label class="option-label"><input type="checkbox" name="q22[]" value="d" id="q22d"> d. Memiliki timer kedaluwarsa yang lebih lama dibandingkan entri dinamis.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">23. Ketika sebuah host menerima ARP Request yang ditujukan untuk alamat IP-nya sendiri, tindakan apa yang akan dilakukan host tersebut selain mengirim ARP Reply?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q23" value="a" id="q23a"> a. Memperbarui ARP cache-nya dengan informasi IP dan MAC dari *pengirim* ARP Request tersebut (jika belum ada atau berbeda).</label>
                    <label class="option-label"><input type="radio" name="q23" value="b" id="q23b"> b. Mengirimkan ARP Request balik ke pengirim.</label>
                    <label class="option-label"><input type="radio" name="q23" value="c" id="q23c"> c. Mengabaikan ARP Request tersebut jika sudah ada entri untuk pengirim di cache.</label>
                    <label class="option-label"><input type="radio" name="q23" value="d" id="q23d"> d. Menghapus entri lama untuk pengirim dari cache sebelum menambahkan yang baru.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">24. Bagaimana sebuah switch Layer 2 standar menangani frame ARP Request yang diterimanya di sebuah port?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q24" value="a" id="q24a"> a. Meneruskan frame tersebut hanya ke port tempat default gateway terhubung.</label>
                    <label class="option-label"><input type="radio" name="q24" value="b" id="q24b"> b. Memeriksa ARP cache switch dan membalas jika memiliki entri.</label>
                    <label class="option-label"><input type="radio" name="q24" value="c" id="q24c"> c. Membanjiri (flood) frame tersebut ke semua port aktif lainnya dalam VLAN yang sama (kecuali port asal).</label>
                    <label class="option-label"><input type="radio" name="q24" value="d" id="q24d"> d. Menjatuhkan (drop) frame tersebut karena switch tidak memproses ARP.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">25. Dalam situasi manakah sebuah host biasanya *tidak* perlu melakukan proses ARP untuk mengirimkan sebuah paket? (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q25[]" value="a" id="q25a"> a. Ketika mengirim paket ke host tujuan di subnet lokal yang entrinya sudah ada di ARP cache.</label>
                    <label class="option-label"><input type="checkbox" name="q25[]" value="b" id="q25b"> b. Ketika mengirim paket ke host tujuan di jaringan remote yang entri *default gateway*-nya sudah ada di ARP cache.</label>
                    <label class="option-label"><input type="checkbox" name="q25[]" value="c" id="q25c"> c. Ketika mengirim paket ke alamat loopback (misal: 127.0.0.1).</label>
                    <label class="option-label"><input type="checkbox" name="q25[]" value="d" id="q25d"> d. Ketika mengirim paket broadcast lapisan 3 (misal: ke 255.255.255.255).</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">26. Seorang analis memantau jaringan dan melihat beberapa ARP Reply yang berbeda untuk *alamat IP yang sama* (misalnya, IP default gateway) tetapi dengan *alamat MAC yang berbeda*. Ini adalah indikasi kuat dari kemungkinan adanya:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q26" value="a" id="q26a"> a. Kegagalan fungsi switch (hardware failure).</label>
                    <label class="option-label"><input type="radio" name="q26" value="b" id="q26b"> b. Serangan ARP spoofing/poisoning.</label>
                    <label class="option-label"><input type="radio" name="q26" value="c" id="q26c"> c. Penggunaan IP address duplikat di jaringan.</label>
                    <label class="option-label"><input type="radio" name="q26" value="d" id="q26d"> d. Proses normal pembaruan ARP table.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">27. Bagaimana segmentasi jaringan menggunakan VLAN mempengaruhi penyebaran pesan ARP Request?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q27" value="a" id="q27a"> a. ARP Request dapat secara bebas melewati antar VLAN yang berbeda tanpa routing.</label>
                    <label class="option-label"><input type="radio" name="q27" value="b" id="q27b"> b. ARP Request hanya disebarkan (broadcast) di dalam batas broadcast domain VLAN tempat request tersebut berasal.</label>
                    <label class="option-label"><input type="radio" name="q27" value="c" id="q27c"> c. Switch akan mengubah ARP Request menjadi unicast ketika melewati trunk link antar switch.</label>
                    <label class="option-label"><input type="radio" name="q27" value="d" id="q27d"> d. VLAN tidak mempengaruhi penyebaran ARP sama sekali.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">28. Saat sebuah paket IP berjalan dari host sumber di satu LAN, melalui beberapa router, ke host tujuan di LAN lain, alamat mana yang tetap tidak berubah dari awal sampai akhir perjalanan paket tersebut?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q28" value="a" id="q28a"> a. Alamat MAC sumber frame Ethernet.</label>
                    <label class="option-label"><input type="radio" name="q28" value="b" id="q28b"> b. Alamat MAC tujuan frame Ethernet.</label>
                    <label class="option-label"><input type="radio" name="q28" value="c" id="q28c"> c. Alamat IP sumber paket IP.</label>
                    <label class="option-label"><input type="radio" name="q28" value="d" id="q28d"> d. Alamat IP next-hop router paket IP.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">29. Jika seorang administrator secara manual menghapus seluruh entri dari ARP cache dinamis sebuah host (`arp -d *` di Windows), apa konsekuensi langsungnya saat host tersebut mencoba berkomunikasi lagi?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q29" value="a" id="q29a"> a. Host tidak akan bisa berkomunikasi sama sekali sampai di-restart.</label>
                    <label class="option-label"><input type="radio" name="q29" value="b" id="q29b"> b. Host akan perlu melakukan proses ARP Request lagi untuk setiap tujuan lokal (atau gateway untuk tujuan remote) saat komunikasi pertama kali dilakukan setelah penghapusan.</label>
                    <label class="option-label"><input type="radio" name="q29" value="c" id="q29c"> c. Host akan secara otomatis meminta ARP table dari default gateway.</label>
                    <label class="option-label"><input type="radio" name="q29" value="d" id="q29d"> d. Komunikasi akan berjalan normal tanpa ada perubahan yang terlihat.</label>
                </div>
            </div>

            <div class="question-block">
                 <p class="question-text">30. Dalam header Ethernet (Layer 2) yang membungkus pesan ARP: (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q30[]" value="a" id="q30a"> a. Alamat MAC tujuan untuk ARP Request adalah MAC address spesifik dari target IP.</label>
                    <label class="option-label"><input type="checkbox" name="q30[]" value="b" id="q30b"> b. Alamat MAC tujuan untuk ARP Request adalah alamat broadcast (FF:FF:FF:FF:FF:FF).</label>
                    <label class="option-label"><input type="checkbox" name="q30[]" value="c" id="q30c"> c. Alamat MAC tujuan untuk ARP Reply adalah alamat broadcast (FF:FF:FF:FF:FF:FF).</label>
                    <label class="option-label"><input type="checkbox" name="q30[]" value="d" id="q30d"> d. Alamat MAC tujuan untuk ARP Reply adalah MAC address host yang *mengirim* ARP Request awal.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">31. Salah satu perbedaan fungsional antara Neighbor Discovery (ND) di IPv6 dan ARP di IPv4 adalah bahwa ND juga digunakan untuk: (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q31[]" value="a" id="q31a"> a. Penemuan router (Router Discovery - RS/RA).</label>
                    <label class="option-label"><input type="checkbox" name="q31[]" value="b" id="q31b"> b. Autokonfigurasi alamat (Stateless Address Autoconfiguration - SLAAC).</label>
                    <label class="option-label"><input type="checkbox" name="q31[]" value="c" id="q31c"> c. Resolusi alamat IP ke MAC (Address Resolution - NS/NA).</label>
                    <label class="option-label"><input type="checkbox" name="q31[]" value="d" id="q31d"> d. Menerjemahkan nama domain ke alamat IPv6.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">32. Setelah berhasil melakukan ARP poisoning dan mengarahkan trafik korban melalui perangkatnya (MitM), apa yang dapat dilakukan oleh penyerang terhadap trafik tersebut? (lebih dari satu jawaban)</p>
                <div>
                    <label class="option-label"><input type="checkbox" name="q32[]" value="a" id="q32a"> a. Membaca (sniffing) data yang tidak terenkripsi.</label>
                    <label class="option-label"><input type="checkbox" name="q32[]" value="b" id="q32b"> b. Memodifikasi data yang lewat (jika memungkinkan dan tidak terproteksi integritasnya).</label>
                    <label class="option-label"><input type="checkbox" name="q32[]" value="c" id="q32c"> c. Memblokir sebagian atau seluruh trafik korban.</label>
                    <label class="option-label"><input type="checkbox" name="q32[]" value="d" id="q32d"> d. Mempercepat koneksi internet korban dengan mengoptimalkan rute.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">33. Apakah setiap pengiriman paket IP ke host lain *selalu* didahului oleh proses ARP Request/Reply?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q33" value="a" id="q33a"> a. Ya, ARP selalu diperlukan untuk setiap paket IP.</label>
                    <label class="option-label"><input type="radio" name="q33" value="b" id="q33b"> b. Tidak, ARP hanya diperlukan jika pemetaan MAC tujuan (baik host lokal atau gateway) belum ada di cache.</label>
                    <label class="option-label"><input type="radio" name="q33" value="c" id="q33c"> c. Tidak, ARP hanya digunakan untuk komunikasi dalam jaringan lokal, tidak pernah untuk gateway.</label>
                    <label class="option-label"><input type="radio" name="q33" value="d" id="q33d"> d. Ya, tetapi hanya jika komunikasi menggunakan protokol TCP, bukan UDP.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">34. Jika sebuah entri ARP dinamis untuk host lokal B dihapus dari cache host A karena timer kedaluwarsa, dan kemudian host A perlu mengirim data lagi ke host B, apa yang akan terjadi?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q34" value="a" id="q34a"> a. Host A akan menganggap Host B tidak dapat dijangkau.</label>
                    <label class="option-label"><input type="radio" name="q34" value="b" id="q34b"> b. Host A akan mengirimkan ARP Request baru untuk menemukan MAC address Host B lagi.</label>
                    <label class="option-label"><input type="radio" name="q34" value="c" id="q34c"> c. Host A akan menggunakan MAC address broadcast untuk mengirim data ke Host B.</label>
                    <label class="option-label"><input type="radio" name="q34" value="d" id="q34d"> d. Host A akan meminta pembaruan ARP table dari switch.</label>
                </div>
            </div>

             <div class="question-block">
                <p class="question-text">35. Dalam sebuah pesan ARP Reply yang valid, alamat MAC sumber (source MAC address) pada payload ARP adalah milik:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q35" value="a" id="q35a"> a. Host yang mengirim ARP Request awal.</label>
                    <label class="option-label"><input type="radio" name="q35" value="b" id="q35b"> b. Host yang alamat IP-nya *merupakan target* dari ARP Request awal (yang mengirim reply).</label>
                    <label class="option-label"><input type="radio" name="q35" value="c" id="q35c"> c. Default gateway dari jaringan tersebut.</label>
                    <label class="option-label"><input type="radio" name="q35" value="d" id="q35d"> d. Alamat MAC broadcast.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">36. Jika sebuah PC gagal melakukan resolusi ARP untuk mendapatkan MAC address dari default gateway-nya, manakah jenis konektivitas yang paling mungkin *gagal secara langsung* akibat masalah ARP ini?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q36" value="a" id="q36a"> a. Konektivitas ke printer di jaringan lokal yang sama.</label>
                    <label class="option-label"><input type="radio" name="q36" value="b" id="q36b"> b. Konektivitas ke server file di jaringan lokal yang sama.</label>
                    <label class="option-label"><input type="radio" name="q36" value="c" id="q36c"> c. Konektivitas ke website di internet.</label>
                    <label class="option-label"><input type="radio" name="q36" value="d" id="q36d"> d. Konektivitas ke PC lain di jaringan lokal yang sama.</label>
                </div>
            </div>

            <div class="question-block">
                 <p class="question-text">37. Fitur Dynamic ARP Inspection (DAI) pada switch Cisco seringkali bergantung pada informasi yang dikumpulkan oleh fitur keamanan lain untuk memvalidasi binding IP-MAC. Fitur pendukung utama tersebut adalah:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q37" value="a" id="q37a"> a. Port Security</label>
                    <label class="option-label"><input type="radio" name="q37" value="b" id="q37b"> b. DHCP Snooping</label>
                    <label class="option-label"><input type="radio" name="q37" value="c" id="q37c"> c. Spanning Tree Protocol (STP)</label>
                    <label class="option-label"><input type="radio" name="q37" value="d" id="q37d"> d. Access Control Lists (ACLs)</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">38. Di dalam payload (message body) sebuah ARP Request, field "Target Hardware Address" (alamat MAC tujuan) biasanya diisi dengan nilai:</p>
                <div>
                    <label class="option-label"><input type="radio" name="q38" value="a" id="q38a"> a. Alamat MAC pengirim.</label>
                    <label class="option-label"><input type="radio" name="q38" value="b" id="q38b"> b. Alamat MAC broadcast (FF:FF:FF:FF:FF:FF).</label>
                    <label class="option-label"><input type="radio" name="q38" value="c" id="q38c"> c. Alamat MAC yang terdiri dari semua nol (00:00:00:00:00:00) atau terkadang kosong.</label>
                    <label class="option-label"><input type="radio" name="q38" value="d" id="q38d"> d. Alamat MAC default gateway.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">39. Bagaimana sifat penyimpanan ARP cache dinamis pada kebanyakan sistem operasi?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q39" value="a" id="q39a"> a. Disimpan secara permanen di hard disk.</label>
                    <label class="option-label"><input type="radio" name="q39" value="b" id="q39b"> b. Disimpan di memori (RAM) dan isinya akan hilang saat sistem di-reboot.</label>
                    <label class="option-label"><input type="radio" name="q39" value="c" id="q39c"> c. Disimpan di konfigurasi startup router/switch.</label>
                    <label class="option-label"><input type="radio" name="q39" value="d" id="q39d"> d. Dicadangkan secara otomatis ke cloud.</label>
                </div>
            </div>

            <div class="question-block">
                <p class="question-text">40. Mengapa pemrosesan ARP Request oleh *setiap* host di segmen jaringan (bukan hanya target) dianggap sebagai overhead?</p>
                <div>
                    <label class="option-label"><input type="radio" name="q40" value="a" id="q40a"> a. Karena setiap host harus mengirim ARP Reply, menyebabkan tabrakan.</label>
                    <label class="option-label"><input type="radio" name="q40" value="b" id="q40b"> b. Karena setiap host harus menghentikan sementara aktivitas jaringannya untuk memproses request.</label>
                    <label class="option-label"><input type="radio" name="q40" value="c" id="q40c"> c. Karena CPU setiap host harus memeriksa apakah Target IP Address dalam request cocok dengan IP address miliknya sendiri.</label>
                    <label class="option-label"><input type="radio" name="q40" value="d" id="q40d"> d. Karena ARP Request menggunakan header yang sangat besar dibandingkan data biasa.</label>
                </div>
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                    Selesai Ujian
                </button>
            </div>

        </form>

        <div id="result" class="mt-8 p-4 bg-gray-100 rounded-lg text-center text-xl font-semibold hidden">
            </div>
    </div>

    <script>
        // --- Kunci Jawaban ---
        const correctAnswers = {
            q1: 'c', q2: 'b', q3: 'b', q4: 'c', q5: 'c',
            q6: 'b', q7: ['a', 'c'], q8: 'c', q9: ['a', 'b'], q10: 'b',
            q11: 'b', q12: 'b', q13: 'd', q14: 'b', q15: ['c', 'd'],
            q16: 'b', q17: 'b', q18: 'd', q19: ['b', 'd'], q20: 'a',
            q21: 'b', q22: ['a', 'b'], q23: 'a', q24: 'c', q25: ['a', 'b', 'c'],
            q26: 'b', q27: 'b', q28: 'c', q29: 'b', q30: ['b', 'd'],
            q31: ['a', 'b', 'c'], q32: ['a', 'b', 'c'], q33: 'b', q34: 'b', q35: 'b',
            q36: 'c', q37: 'b', q38: 'c', q39: 'b', q40: 'c'
        };
        // ---------------------

        const totalQuestions = Object.keys(correctAnswers).length;
        const form = document.getElementById('quiz-form');
        const resultDiv = document.getElementById('result');

        // Tambahkan event listener ke form saat disubmit
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form standar
            console.log("Form submitted!"); // DEBUG: Cek apakah event handler terpicu

            let score = 0;
            const formData = new FormData(form); // Ambil semua data dari form

            // Iterasi melalui setiap kunci jawaban untuk memeriksa jawaban pengguna
            for (const questionName in correctAnswers) {
                console.log(`Checking question: ${questionName}`); // DEBUG: Tampilkan soal yang dicek
                const correctAnswer = correctAnswers[questionName];
                const isCheckbox = Array.isArray(correctAnswer); // Cek apakah ini soal checkbox

                if (!isCheckbox) {
                    // --- Logika untuk Soal Radio Button ---
                    const userAnswer = formData.get(questionName); // Ambil jawaban radio yang dipilih
                    console.log(`  Type: Radio, User Answer: ${userAnswer}, Correct: ${correctAnswer}`); // DEBUG
                    if (userAnswer === correctAnswer) {
                        score++;
                        console.log("  Radio Correct!"); // DEBUG
                    }
                } else {
                    // --- Logika untuk Soal Checkbox ---
                    const checkboxName = questionName + '[]'; // Nama input checkbox di HTML
                    const userAnswers = formData.getAll(checkboxName); // Ambil semua checkbox yang dicentang
                    console.log(`  Type: Checkbox, User Answers: [${userAnswers.join(', ')}], Correct: [${correctAnswer.join(', ')}]`); // DEBUG

                    // Urutkan jawaban pengguna dan kunci jawaban untuk perbandingan yang konsisten
                    const sortedUserAnswers = userAnswers.sort();
                    const sortedCorrectAnswers = [...correctAnswer].sort(); // Salin array sebelum diurutkan

                    // Bandingkan apakah jawaban pengguna sama persis dengan kunci jawaban
                    const isCorrect = sortedUserAnswers.length === sortedCorrectAnswers.length &&
                        sortedUserAnswers.every((value, index) => value === sortedCorrectAnswers[index]);

                    if (isCorrect) {
                        score++;
                        console.log("  Checkbox Correct!"); // DEBUG
                    }
                }
            }

            console.log(`Final Score: ${score}`); // DEBUG: Tampilkan skor akhir di konsol

            // Tampilkan hasil skor ke pengguna
            resultDiv.textContent = `Skor Anda: ${score} / ${totalQuestions}`;
            resultDiv.classList.remove('hidden'); // Tampilkan div hasil
            console.log("Result displayed."); // DEBUG: Konfirmasi hasil ditampilkan

            // Gulir ke bagian hasil (opsional)
            resultDiv.scrollIntoView({ behavior: 'smooth' });

            // Nonaktifkan semua input dan tombol submit setelah selesai (opsional)
            console.log("Disabling inputs..."); // DEBUG: Konfirmasi proses nonaktifkan
             const inputs = form.querySelectorAll('input');
             inputs.forEach(input => input.disabled = true);
             const submitButton = form.querySelector('button[type="submit"]');
             if (submitButton) {
                 submitButton.disabled = true;
                 submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                 submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                 console.log("Button disabled."); // DEBUG
             } else {
                 console.error("Submit button not found!"); // DEBUG: Jika tombol tidak ditemukan
             }
        });
    </script>

</body>
</html>
```

**Perubahan:**

* Saya menambahkan beberapa `console.log` di dalam JavaScript. Jika Anda membuka konsol developer browser Anda saat menjalankan simulasi dan menekan tombol "Selesai Ujian", Anda akan melihat log ini yang menunjukkan apakah event terpicu, soal mana yang sedang diperiksa, jawaban Anda, jawaban benar, dan skor akhir. Ini sangat membantu untuk melihat di mana letak masalahnya jika masih terjadi.
* Saya juga menambahkan `id` unik ke setiap input radio/checkbox (misalnya `id="q1a"`, `id="q7b"`) meskipun tidak secara langsung digunakan oleh JavaScript saat ini, ini adalah praktik HTML yang baik, terutama jika Anda ingin menghubungkan label secara eksplisit dengan `for` di masa mendatang.

Silakan coba lagi dengan kode ini. Jika masih bermasalah, coba buka konsol developer dan lihat apakah ada pesan error yang muncul saat Anda menekan tombol subm