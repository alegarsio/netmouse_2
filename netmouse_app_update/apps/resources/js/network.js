/**
 * Author : Alegrarsio Gifta Lesmana
 * 
 * NetMouse Network Simulation Engine
 * 
 * Function :
 * 
 * >> AddDevice() 
 * >> RemoveDevice() 
 * >> ConnectDevice() 
 * 
 * Icon by : https://fontawesome.com/
 * Image by : https://www.flaticon.com/
 *  
 * => AF_INET Addressing
 * TCP => SOCK_STREAM Proto & ICMP
 * 
 * 
 */

__author__ = "Alegrarsio Gifta Lesmana";
__contain__ = "NetSimulation engine";

document.addEventListener("DOMContentLoaded", function() {

    const portMapping = {
        'ssh': 22,
        'ftp': 21,
        'http': 80,
        'https': 443,
        'smtp': 25,
        'telnet': 23
    };

    /**
     * 
     * @param {*} ip 
     * @returns 
     */

    /** Parse IP4 to 32 bit format integer 
     * Support AF_INET -> IPV4 
     * */

    function ipToInt(ip) { 
        return ip.split('.').map(Number).reduce((int, octet) => (int << 8) + octet, 0);
    }
    /**
     * 
     * @param {*} int 
     * @returns 
     * 
     * Parse Int to AF_INET Format
     */
    
    function IntToIp(int) {
        return [
            (int >>> 24) & 0xFF,
            (int >>> 16) & 0xFF,
            (int >>> 8) & 0xFF,
            int & 0xFF
        ].join('.');
    }

    function calculateSubnet(ip, subnetMask) {
        const ipInt = ipToInt(ip);
        const subnetMaskInt = ipToInt(subnetMask);
        const networkAddressInt = ipInt & subnetMaskInt;
        return IntToIp(networkAddressInt);
    }
   
    
    function openPort() {
       
        const deviceId = prompt("Masukkan ID perangkat yang ingin membuka port:");
        if (!deviceId) return;
        const device = document.getElementById(deviceId);
        if (!device) {
            alert("Perangkat tidak ditemukan.");
            return;
        }
    
        
        const service = prompt("Masukkan layanan yang ingin dibuka (SSH, FTP, dll.):");
        if (!service) return;
        
        
        const portNumber = portMapping[service.toUpperCase()];
        if (!portNumber) {
            alert("Layanan tidak dikenal. Silakan coba lagi.");
            return;
        }
    
        
        if (!device.activePorts) {
            device.activePorts = [];
        }
    
        
        if (!device.activePorts.includes(portNumber)) {
            device.activePorts.push(portNumber);
            alert(`Port ${portNumber} (${service}) pada perangkat ${deviceId} telah dibuka.`);
        } else {
            alert(`Port ${portNumber} (${service}) sudah aktif pada perangkat ${deviceId}.`);
        }
    }

    const closeport = document.getElementById("closePortButton")
    closeport.addEventListener("click",function(){
        closePort()
    });
    function closePort() {
   
    const deviceId = prompt("Masukkan ID perangkat yang ingin menutup port:");
    if (!deviceId) return;
    const device = document.getElementById(deviceId);
    if (!device) {
        alert("Perangkat tidak ditemukan.");
        return;
    }

    
    const service = prompt("Masukkan layanan yang ingin ditutup :");
    if (!service) return;
    
    
    const portNumber = portMapping[service.toUpperCase()];
    if (!portNumber) {
        alert("Layanan tidak dikenal. Silakan coba lagi.");
        return;
    }

    
    if (!device.activePorts) {
        alert("Perangkat tidak mendukung port yang dipilih.");
        return;
    }

    
    const portIndex = device.activePorts.indexOf(portNumber);
    if (portIndex !== -1) {
        device.activePorts.splice(portIndex, 1);
        alert(`Port ${portNumber} (${service}) pada perangkat ${deviceId} telah dihapus.`);
    } else {
        alert(`Port ${portNumber} (${service}) tidak aktif pada perangkat ${deviceId}.`);
    }
}
    function isSameNetwork(ip1, ip2, subnetMask) {
        const ipInt1 = ipToInt(ip1);
        const ipInt2 = ipToInt(ip2);
        const subnetMaskInt = ipToInt(subnetMask);

        return (ipInt1 & subnetMaskInt) === (ipInt2 & subnetMaskInt);
    }

    function establishSSHConnection() {
        
        const sourceDeviceId = prompt("Masukkan ID perangkat sumber:");
        if (!sourceDeviceId) return;
        const sourceDevice = document.getElementById(sourceDeviceId);
        if (!sourceDevice) {
            alert("Perangkat sumber tidak ditemukan.");
            return;
        }
    
       
        const targetDeviceId = prompt("Masukkan ID perangkat tujuan:");
        if (!targetDeviceId) return;
        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            alert("Perangkat tujuan tidak ditemukan.");
            return;
        }
    
        const username = prompt("Masukkan nama pengguna (default: admin):") || "admin";
        const password = prompt("Masukkan password (default: admin):") || "admin";
    
       
        if (username !== "admin" || password !== "admin") {
            alert("Nama pengguna atau password salah. Koneksi SSH gagal.");
            return;
        }
    
        
        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
        if (!isSameNetwork(sourceIpAddress, targetIpAddress, "255.255.255.0")) {
            alert("Perangkat sumber dan tujuan tidak berada dalam jaringan yang sama.");
            return;
        }
    
        
        const sourcePorts = sourceDevice.activePorts || [];
        const targetPorts = targetDevice.activePorts || [];
        if (!sourcePorts.includes(22) || !targetPorts.includes(22)) {
            alert("Salah satu perangkat tidak memiliki port 22 yang aktif.");
            return;
        }
    
        
        alert(`Koneksi SSH berhasil antara ${sourceDeviceId} dan ${targetDeviceId}.`);
    
 
        const command = prompt("Masukkan perintah yang ingin dijalankan di perangkat tujuan (ipconfig, dir, etc):");
    
        
        if (command === "ipconfig") {
            
            alert(`Ipv4 : ${targetDevice.id}: ${targetIpAddress}`);
        } else if (command === "dir") {
            
            const directoryContents = "/usr/ /bin/ /etc/"; 
            alert(`Daftar isi direktori perangkat ${targetDevice.id}: ${directoryContents}`);
        } else {
            
            alert(`Perintah tidak dikenal: ${command}`);
        }
    }
    
    const sshButton = document.getElementById("sshButton");
    sshButton.addEventListener("click", establishSSHConnection);
    

    const defaultPorts = {
        'server': [21, 22, 23, 25, 80,443], 
        'router': [21, 22, 23, 80], 
        'laptop': [21, 22, 80], 
        'pc': [21, 22, 80],
        'access-point':[80],
        'wifi-router':[80],
        'file-server':[80,21,22]
    };
    
    let isRemoving = false;
    
    const devicesContainer = document.getElementById("devicesContainer");
    const removeDeviceBtn = document.getElementById("removeDeviceBtn");
    let activeItem = null;
    let offsetX = 0;
    let offsetY = 0;
    let isConnecting = false;
    let startDevice = null;
    let currentCable = null;
    let isSelectingDevices = false;
    let selectedDevices = [];
    let clickCount = 0; 
    let isRightClick = false; 
    const addCircleBtn = document.getElementById("addCircleBtn");


    let isConnectionMode = false; 
    let selectedSourceDevice = null; 
    let selectedTargetDevice = null;
    addCircleBtn.addEventListener("click", function() {
        addCircleArea();
    });

    const sendPacketBtn = document.getElementById("sendPacketBtn");


sendPacketBtn.addEventListener("click", function() {
    
    const sourceDeviceId = prompt("Masukkan ID perangkat sumber:");
    if (!sourceDeviceId) {
        alert("ID perangkat sumber tidak valid.");
        return;
    }
    const sourceDevice = document.getElementById(sourceDeviceId);
    if (!sourceDevice) {
        alert("Perangkat sumber tidak ditemukan.");
        return;
    }

   
    const targetDeviceId = prompt("Masukkan ID perangkat tujuan:");
    if (!targetDeviceId) {
        alert("ID perangkat tujuan tidak valid.");
        return;
    }
    const targetDevice = document.getElementById(targetDeviceId);
    if (!targetDevice) {
        alert("Perangkat tujuan tidak ditemukan.");
        return;
    }

    sendPacket(sourceDevice, targetDevice);
});


/**
 * 
 * @param {*} sourceDevice 
 * @param {*} targetDevice 
 * @returns 
 */




function areDevicesConnected(sourceDevice, targetDevice) {
    const connectedDevices = networkTopology[sourceDevice.id];
    return connectedDevices && connectedDevices.includes(targetDevice.id);
}

/**
 * 
 * @param {*} sourceDevice 
 * @param {*} targetDevice 
 * @returns 
 */

function sendPacket(sourceDevice, targetDevice) {
    const sourceIpAddress = getIpAddress(sourceDevice);
    if (!sourceIpAddress || sourceIpAddress === '0.0.0.0') {
        alert("Perangkat sumber belum memiliki alamat IP.");
        return;
    }

    const targetIpAddress = getIpAddress(targetDevice);
    if (!targetIpAddress || targetIpAddress === '0.0.0.0') {
        alert("Perangkat tujuan belum memiliki alamat IP.");
        return;
    }

    const sourceGateway = sourceDevice.gateway || '0.0.0.0';
    const targetGateway = targetDevice.gateway || '0.0.0.0';

    function isSameNetwork(ip1, ip2, subnetMask) {
        const ipInt1 = ipToInt(ip1);
        const ipInt2 = ipToInt(ip2);
        const subnetMaskInt = ipToInt(subnetMask);
        return (ipInt1 & subnetMaskInt) === (ipInt2 & subnetMaskInt);
    }

    const subnetMask = "255.255.255.0";

    if (isSameNetwork(sourceIpAddress, targetIpAddress, subnetMask)) {
        alert(`Success Src : ${sourceIpAddress} Dst : ${targetIpAddress}`);
    } else if (sourceGateway === targetGateway && sourceGateway !== '0.0.0.0') {
        alert(`Success Src : ${sourceIpAddress} Dst : ${targetIpAddress} Trough Gateway: ${sourceGateway}`);
    } else {
        alert(`Gagal Src: ${sourceIpAddress} Dst:${targetIpAddress}. Destination Unreachable.`);
    }
}

    
    
/**
 * 
 * @param {*} device 
 * @returns 
 */


function getIpAddress(device) {
    const ipAddressElement = device.querySelector(".ip-address");
    return ipAddressElement ? ipAddressElement.innerText : null;
}

    function addCircleArea() {
        const circleArea = document.createElement("div");
        circleArea.classList.add("circle-area");

        circleArea.style.left = "100px";
        circleArea.style.top = "100px";

        circleArea.draggable = true;
        circleArea.addEventListener("dragstart", function(event) {
            event.dataTransfer.setData("text/plain", "circle");
        });

        devicesContainer.appendChild(circleArea);
    }

    devicesContainer.addEventListener("dragover", function(event) {
        event.preventDefault();
    });

    devicesContainer.addEventListener("drop", function(event) {
        event.preventDefault();
        const data = event.dataTransfer.getData("text/plain");
        if (data === "circle") {
            const circleArea = document.querySelector(".circle-area");
            const rect = devicesContainer.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;
            circleArea.style.left = x + "px";
            circleArea.style.top = y + "px";
        }
    });
   

    const clearLinesBtn = document.getElementById("hapusGarisBtn");

    clearLinesBtn.addEventListener("click", function() {
        clearLines();
    });

    function clearLines() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    const addConnectionBtn = document.getElementById("addConnectionBtn");

    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    let isDrawing = false;
    let startX, startY, endX, endY;

    canvas.addEventListener("mousedown", function(e) {
        isDrawing = true;
        startX = e.clientX - canvas.getBoundingClientRect().left;
        startY = e.clientY - canvas.getBoundingClientRect().top;
    });

    canvas.addEventListener("mousemove", function(e) {
        if (isDrawing) {
            endX = e.clientX - canvas.getBoundingClientRect().left;
            endY = e.clientY - canvas.getBoundingClientRect().top;
            drawLine(startX, startY, endX, endY);
            startX = endX;
            startY = endY;
        }
    });

    canvas.addEventListener("mouseup", function() {
        isDrawing = false;
    });

    /**
     * 
     * @param {*} startX 
     * @param {*} startY 
     * @param {*} endX 
     * @param {*} endY 
     * @param {*} color 
     * @param {*} lineWidth 
     */

    function drawLine(startX, startY, endX, endY, color = "black", lineWidth = 5) {
       
        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(endX, endY);
        ctx.strokeStyle = color; 
        ctx.lineWidth = lineWidth; 
        ctx.lineCap = "round";
        ctx.lineJoin = "round";
        ctx.stroke();
        ctx.closePath();
    
       
        setTimeout(() => {
            ctx.beginPath();
            ctx.moveTo(startX, startY);
            ctx.lineTo(endX, endY);
            ctx.strokeStyle = 'black'; 
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.closePath();
        }, 4000);
    }
    devicesContainer.addEventListener("click", function (event) {
     
        if (isConnectionMode) {

            const clickedElement = event.target.closest(".device");
            
            if (clickedElement) {
                
                if (!selectedSourceDevice) {
                    selectedSourceDevice = clickedElement;
                    
                } else if (!selectedTargetDevice && clickedElement !== selectedSourceDevice) {
                    
                    selectedTargetDevice = clickedElement;
                    
                    
                    // Setelah kedua perangkat dipilih, hubungkan perangkat
                    if (selectedSourceDevice && selectedTargetDevice) {
                        connectDevices(selectedSourceDevice, selectedTargetDevice);
                        
                        // Reset mode koneksi setelah menghubungkan perangkat
                        isConnectionMode = false;
                        selectedSourceDevice = null;
                        selectedTargetDevice = null;
                        document.body.style.cursor = "default"; // Kembalikan kursor ke default
                    }
                }
            }
        }
    });
    function drawConnectionLine(sourceDevice, targetDevice) {
        const startX = sourceDevice.offsetLeft + sourceDevice.offsetWidth / 2;
        const startY = sourceDevice.offsetTop + sourceDevice.offsetHeight / 2;
        const endX = targetDevice.offsetLeft + targetDevice.offsetWidth / 2;
        const endY = targetDevice.offsetTop + targetDevice.offsetHeight / 2;
        drawLine(startX, startY, endX, endY);
    }
    function connectDevices(sourceDevice, targetDevice) {
        
        alert(`Menghubungkan ${sourceDevice.id} ke ${targetDevice.id}`);
       
        drawConnectionLine(sourceDevice, targetDevice);
    }
    addConnectionBtn.addEventListener("click", function () {
       
        isConnectionMode = !isConnectionMode;
    
        if (isConnectionMode) {
          
            alert("Mode koneksi diaktifkan. Klik perangkat sumber dan perangkat tujuan untuk menghubungkannya.");
            document.body.style.cursor = "pointer";
        } else {

            alert("Mode koneksi dinonaktifkan.");
            document.body.style.cursor = "default";
            selectedSourceDevice = null; 
            selectedTargetDevice = null; 
        }
    });
    function startDrawLine() {
        isDrawing = true;
    }

    document.addEventListener("mousedown", function(e) {
     
        isRightClick = e.button === 2;
        
        if (e.ctrlKey && isRightClick) {
            isConnecting = true;
            handleConnectionMode();
        }
      
        else {
            handleMouseDown(e);
        }
    });

    document.addEventListener("mousemove", handleMouseMove);
    document.addEventListener("mouseup", handleMouseUp);
    document.addEventListener("touchstart", handleTouchStart);
    document.addEventListener("touchmove", handleTouchMove);
    document.addEventListener("touchend", handleTouchEnd);

    removeDeviceBtn.addEventListener("click", function() {
        isSelectingDevices = true;
    });
    removeDeviceBtn.addEventListener("click", function() {
        isRemoving = !isRemoving; 
        if (isRemoving) {
            alert("Mode hapus diaktifkan. Pilih perangkat atau kabel yang ingin dihapus.");
            document.body.style.cursor = "crosshair"; 
        } else {
            alert("Mode hapus dinonaktifkan.");
            document.body.style.cursor = "default"; 
        }
    });
    /**
     * 
     * @param {*} e 
     * @returns 
     */
    function handleMouseDown(e) {
        clickCount++; 
        if (clickCount === 2) { 
            if (!isConnecting) {
                alertInfo();
            }
            clickCount = 0;
        }

        if (e.target.classList.contains("device")) {
            if (isSelectingDevices) {
                removeDevice(e.target);
                return;
            }
            activeItem = e.target;
            activeItem.style.zIndex = "1000";
            const rect = activeItem.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;

            if (isConnecting) {
                startDevice = activeItem;
                drawCableStart(startDevice);
            }
        }
    }
    /**
     * 
     * @param {*} e 
     * @returns 
     */
    function handleTouchStart(e) {
        clickCount++; 
        if (clickCount === 3) { 
            if (!isConnecting) {
                alertInfo();
            }
            clickCount = 0;
        }

        const touch = e.touches[0];
        if (touch.target.classList.contains("device")) {
            if (isSelectingDevices) {
                removeDevice(touch.target);
                return;
            }
            activeItem = touch.target;
            activeItem.style.zIndex = "1000";
            const rect = activeItem.getBoundingClientRect();
            offsetX = touch.clientX - rect.left;
            offsetY = touch.clientY - rect.top;

            if (isConnecting) {
                startDevice = activeItem;
                drawCableStart(startDevice);
            }
        }
    }
    function checkWPA(device, inputPassword) {
        // Periksa apakah perangkat mendukung WPA
        if (!device.classList.contains("wifi-router") && !device.classList.contains("access-point") && !device.classList.contains("repeater")) {
            displayOutput(`Device ${device.id} does not support WPA.`);
            return false;
        }
    
        // Periksa apakah kata sandi WPA cocok dengan kata sandi yang disimpan di perangkat
        const savedPassword = device.wpaPassword;
        if (inputPassword === savedPassword) {
            return true;
        } else {
            displayOutput(`WPA password mismatch for device ${device.id}.`);
            return false;
        }
    }
    
    function alertInfo() {
        if (!isConnecting && activeItem) {

            alert(`Device Type: ${deviceType}\nDevice ID: ${deviceId}\nIP Address: ${ipAddress}`);
        } 
    }
    /**
     * 
     * @param {*} e 
     */
    function handleMouseMove(e) {
        if (activeItem && activeItem.classList.contains("device")) {
            const mouseX = e.clientX - devicesContainer.getBoundingClientRect().left;
            const mouseY = e.clientY - devicesContainer.getBoundingClientRect().top;
            activeItem.style.left = mouseX - offsetX + "px";
            activeItem.style.top = mouseY - offsetY + "px";

            if (isConnecting && startDevice) {
                drawCableUpdate(mouseX, mouseY);
            }
        }
    }
    /**
     * 
     * @param {*} e 
     */
    function handleTouchMove(e) {
        if (activeItem && activeItem.classList.contains("device")) {
            const touch = e.touches[0];
            const mouseX = touch.clientX - devicesContainer.getBoundingClientRect().left;
            const mouseY = touch.clientY - devicesContainer.getBoundingClientRect().top;
            activeItem.style.left = mouseX - offsetX + "px";
            activeItem.style.top = mouseY - offsetY + "px";

            if (isConnecting && startDevice) {
                drawCableUpdate(mouseX, mouseY);
            }
        }
    }
    /**
     * 
     * @param {*} e 
     */
    function handleMouseUp(e) {
        if (isSelectingDevices) {
            isSelectingDevices = false;
        }
        if (isConnecting && startDevice && e.target.classList.contains("device") && e.target !== startDevice) {
            connectDevices(startDevice, e.target);
        }
        activeItem = null;
        startDevice = null;
        if (currentCable) {
            currentCable.remove();
            currentCable = null;
        }
          
        isConnecting = false;
        handleConnectionMode();
    }

    function handleTouchEnd(e) {
        if (isSelectingDevices) {
            isSelectingDevices = false;
        }
    }

    function handleConnectionMode() {
        if (isConnecting) {
            disableDeviceClick();
        } else {
            enableDeviceClick();
        }
    }

    function disableDeviceClick() {
        const devices = document.querySelectorAll(".device");
        devices.forEach(device => {
            device.removeEventListener("click", showDeviceInfo);
        });
    }

    function enableDeviceClick() {
        const devices = document.querySelectorAll(".device");
        devices.forEach(device => {
            device.addEventListener("click", showDeviceInfo);
        });
    }

    
    
    /**
     * 
     * @param {*} device1 
     * @param {*} device2 
     * @param {*} color 
     * @param {*} width 
     * @returns 
     */
    function connectDevices(device1, device2, color, width) {
        if (device1.classList.contains('router') && device2.classList.contains('router')) {
            alert("Error : kabel tidak didukung.");
            return;
        }
        else if (device1.classList.contains('switch') && device2.classList.contains('switch')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('pc') && device2.classList.contains('pc')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('laptop') && device2.classList.contains('laptop')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('multi-switch') && device2.classList.contains('multi-switch')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('hub') && device2.classList.contains('hub')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('repeater') && device2.classList.contains('repeater')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('wifi-router') && device2.classList.contains('wifi-router')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('voip-phone') && device2.classList.contains('voip-phone')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('printer') && device2.classList.contains('printer')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('server') && device2.classList.contains('server')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('access-point') && device2.classList.contains('access-point')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('modem') && device2.classList.contains('modem')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('multi-switch') && device2.classList.contains('multi-switch')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }
        else if (device1.classList.contains('phone') || device2.classList.contains('phone')) {
            alert("Error : kabel ini tidak didukung .");
            return;
        }

        const startX = device1.offsetLeft + device1.offsetWidth / 2;
        const startY = device1.offsetTop + device1.offsetHeight / 2;
        const endX = device2.offsetLeft + device2.offsetWidth / 2;
        const endY = device2.offsetTop + device2.offsetHeight / 2;
        drawLine(startX, startY, endX, endY, color, width); 
    }
    /**
     * 
     * @param {*} deviceType 
     */
    function addDevice(deviceType) {

        
        const newDevice = document.createElement("div");
        newDevice.classList.add("device", deviceType);
    
        const deviceCount = getDeviceCount(deviceType) + 1;
        const deviceName = `${deviceType.charAt(0).toUpperCase() + deviceType.slice(1)} ${deviceCount}`;
    
        newDevice.innerHTML = `<img src="${deviceType}.png" style="width: 115px; height: 115px;" /> ${deviceName}`;
    
        newDevice.id = `${deviceType}${deviceCount}`;
        newDevice.style.position = "absolute";
        newDevice.style.padding = "10px";
        newDevice.style.borderColor = "white";
        newDevice.style.borderRadius = "30px";
        newDevice.setAttribute("draggable", "true");
    
     
        newDevice.activePorts = defaultPorts[deviceType] || [];
    
        devicesContainer.appendChild(newDevice);
    
        newDevice.addEventListener("click", function() {
            showDeviceInfo.call(newDevice);
        });
    
        newDevice.style.left = "200px";
        newDevice.style.top = "200px";
    }
    /**
     * 
     * @param {*} device 
     */
    function removeDevice(device) {
        if (device) {
            device.remove();
            alert(`Perangkat ${device.id} telah dihapus.`);
        }
    }
    /**
     * 
     * @param {*} cable 
     */
    function removeCable(cable) {
        if (cable) {
            cable.remove();
            alert("Kabel telah dihapus.");
        }
    }
    document.addEventListener("click", function(event) {
        if (isRemoving) {
            const target = event.target;
    
          
            if (target.classList.contains("device")) {
                removeDevice(target);
                isRemoving = false; 
                document.body.style.cursor = "default"; 
            }
    
            if (target.classList.contains("cable")) {
                removeCable(target);
                isRemoving = false; 
                document.body.style.cursor = "default"; 
            }
        }
    });
    function getDeviceIcon(deviceType) {
        switch (deviceType) {
            case "router":
                return "router.png";
            case "switch":
                return "switch.png";
            case "pc":
                return "pc.png";
            case "laptop":
                return "laptop.png";
            case "access-point":
                return "access-point.png";
            case "server":
                return "server.png";
            case "isp":
                return "isp.png";
            case "printer":
                return "printer.png";
            case "phone":
                return "phone.png"
            case "cloud":
                return "cloud.png"
            case "voip-phone":
                return "voip-phone.png"
            case "modem":
                return "modem.png"
            case "hub":
                return "hub.png"
            case "wifi-router":
                return "wifi-router.png"
            case "repeater":
                return "repeater.png"
            default:
                return "";
        }
    }

    function getDeviceCount(deviceType) {
        const existingDevices = document.querySelectorAll(`.device.${deviceType}`);
        return existingDevices.length;
    }
    const cliButton = document.getElementById("cliButton");
    const openPortButton = document.getElementById("openPortButton");
    const addrack = document.getElementById("addrack");
    const addmul = document.getElementById("addmulti");
    const addrepeat = document.getElementById("addrepeater");
    const addwifirouter = document.getElementById("addwifirouter");
    const addhub = document.getElementById("addhub");
    const addgate = document.getElementById("addgateway");
    const addmodem = document.getElementById("addmodem");
    const addip = document.getElementById("addip");
    const addfileserver = document.getElementById("addfileserver");
    const addencript = document.getElementById("addencript");
    const addWPAButton = document.getElementById("addwpa");
    const addfirewall = document.getElementById("addfirewall");
  
    const addphone = document.getElementById("addphone");
    const addRouterBtn = document.getElementById("addRouterBtn");
    const addprinter = document.getElementById("addprinter");
    const addisp = document.getElementById("addisp");
    const addserver = document.getElementById("addserver");
    const addSwitchBtn = document.getElementById("addSwitchBtn");
    const addPCBtn = document.getElementById("addPCBtn");
    const addLaptopBtn = document.getElementById("addLaptopBtn");
    const addAccessPointBtn = document.getElementById("addAccessPointBtn");

    openPortButton.addEventListener("click", openPort);
    cliButton.addEventListener("click", openCLI);
    
    function openCLI() {
   
        const deviceId = prompt("Masukkan ID perangkat yang ingin diakses melalui CLI:");
        if (!deviceId) return;
        const device = document.getElementById(deviceId);
        if (!device) {
            alert("Perangkat tidak ditemukan.");
            return;
        }
    
        
        let cliWindow = document.getElementById("cliWindow");
        if (!cliWindow) {
            cliWindow = document.createElement("div");
            cliWindow.id = "cliWindow";
            cliWindow.style.width = "800px";
            cliWindow.style.height = "700px";
            cliWindow.style.overflowY = "auto";
            cliWindow.style.border = "1px solid #333"; 
            cliWindow.style.position = "absolute";
            cliWindow.style.top = "10%";
            cliWindow.style.left = "10%";
            cliWindow.style.backgroundColor = "#000"; 
            cliWindow.style.color = "#fff"; 
            cliWindow.style.fontFamily = "monospace"; 
            cliWindow.style.cursor = "move"; 
            document.body.appendChild(cliWindow);
    
            
            const closeButton = document.createElement("button");
            closeButton.id = "closeButton";
            closeButton.innerText = "Close";
            closeButton.style.backgroundColor = "#444"; 
            closeButton.style.color = "#fff"; 
            
            
            closeButton.addEventListener("click", function() {
                cliWindow.remove();
            });
    
            
            cliWindow.appendChild(closeButton);
    
            
            makeCLIWindowDraggable(cliWindow);
        }
    
        
        setPrompt(device);
    
        
        cliWindow.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                const cliInput = event.target;
                const command = cliInput.value.trim(); 
                if (command === '') {
                    
                    setPrompt(device);
                } else {
                    executeCommand(device, command);
                    cliInput.value = '';
                    setPrompt(device); 
                }
            }
        });
    
       
        cliWindow.focus();
    }
    
    function setPrompt(device) {
        const cliWindow = document.getElementById("cliWindow");
        if (!cliWindow) return;
    
        const cliLine = document.createElement("div");
        cliLine.style.display = "flex"
        const promptElement = document.createElement("div");
        promptElement.textContent = `C:\\${device.id}> `;
        promptElement.style.color = "#fff";
        promptElement.style.marginRight = "5px"; 
    
        
        const inputElement = document.createElement("input");
        inputElement.id = "cliInput";
        inputElement.style.backgroundColor = "black";
        inputElement.style.color = "#fff";
        inputElement.style.width = "calc(100% - promptElement.offsetWidth)";
        inputElement.style.border = "none";
        inputElement.style.outline = "none";
    
        
        cliLine.appendChild(promptElement);
        cliLine.appendChild(inputElement);
    
        
        cliWindow.appendChild(cliLine);
        cliWindow.scrollTop = cliWindow.scrollHeight;
    
      
        inputElement.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                const command = inputElement.value.trim(); 
                if (command !== "") {
                    executeCommand(device, command); 
                    inputElement.value = ""; 
                    setPrompt(device); 
                }
            }
        });
    
        
        inputElement.focus();
    }
    
    function makeCLIWindowDraggable(cliWindow) {
        let isDragging = false;
        let offsetX, offsetY;
    
        function onMouseDown(event) {
            isDragging = true;
            offsetX = event.clientX - cliWindow.getBoundingClientRect().left;
            offsetY = event.clientY - cliWindow.getBoundingClientRect().top;
            document.addEventListener("mousemove", onMouseMove);
            document.addEventListener("mouseup", onMouseUp);
        }
    
        
        function onMouseMove(event) {
            if (isDragging) {
                cliWindow.style.left = `${event.clientX - offsetX}px`;
                cliWindow.style.top = `${event.clientY - offsetY}px`;
            }
        }
    
       
        function onMouseUp() {
            isDragging = false;
            document.removeEventListener("mousemove", onMouseMove);
            document.removeEventListener("mouseup", onMouseUp);
        }
    
        
        cliWindow.addEventListener("mousedown", onMouseDown);
    }
    function displayOutput(output) {
        const cliWindow = document.getElementById("cliWindow");
        const outputLine = document.createElement("div");
        outputLine.textContent = output;
        cliWindow.appendChild(outputLine);
        cliWindow.scrollTop = cliWindow.scrollHeight;
    }
    
    function executeCommand(device, command) {
        const args = command.split('"');
        const cmd = args[0].trim().toLowerCase();
        const targetDeviceId = args[1] && args[1].trim();
        const ipAddress = args[1] && args[1].trim();
        const subnetMask = args[3] && args[3].trim();
  
       
        if (cmd === "ipconfig") {
            displayIpConfig(device);
        }
        
        else if (cmd === "ip addr set addr" && ipAddress && subnetMask) {
            setIpAddressWithSubnet(device, ipAddress, subnetMask);
        }
        
        else if (cmd === "dir") {
            displayDir(device);
        }
       
        else if (cmd === "make" && targetDeviceId) {
            makeFile(device, targetDeviceId);
        }
       
        else if (cmd === "ping" && targetDeviceId) {
            executePing(device, targetDeviceId);
        }
        
        else if (cmd === "ssh" && targetDeviceId) {
            executeSSH(device, targetDeviceId);
        }
      
        else if (cmd === "firewall on") {
            device.firewallEnabled = true;
            displayOutput(`Firewall status changed up ${device.id}.`);
        }
       
        else if (cmd === "firewall off") {
            device.firewallEnabled = false;
            displayOutput(`Firewall status changed down ${device.id}.`);
        }
      
        else if (cmd === "firewall status") {
            displayFirewallStatus(device);
        }
        else if(cmd == "netstat"){
            displayNetstat(device);
        }
        else if(cmd == "nslookup"){
            executeNSLookup(device,args);
        }
        else if (cmd === "service" && args[1] && args[2].trim() === "-s" && args[3]) {
            const proto = args[1].trim();
            const status = args[3].trim();
            changePortStatus(device, proto, status);
        }
        else if (cmd === "sniff -p" && targetDeviceId) {
            sniffPort(targetDeviceId);
        }
        else if (cmd === "sniff src" && args[1] && args[2].trim() === "dst" && args[3]) {
            const sourceDeviceId = args[1].trim();
            const targetDeviceId = args[3].trim();
            executeMITM(device, sourceDeviceId, targetDeviceId);
        }
        else if (cmd === "ftp -s" && args[1] && args[2].trim() === "f" && args[3]) {
            const targetDeviceId = args[1].trim();
            const fileName = args[3].trim();
            executeFTP(device, targetDeviceId, fileName);
            // ftp -s "pc1" f "index.html"
        } 
        else if (cmd === "ftp -r" && targetDeviceId && args[2].trim() === "f" && args[3]) {
            const targetDeviceId = args[1].trim();
            const fileName = args[3].trim();
            downloadFTPFile(device, targetDeviceId, fileName);
        }
        else if (cmd === "ftp -a" && targetDeviceId) {
            displayFTPFileList(device, targetDeviceId);
            return;
        }
        else if (cmd === "rm" && targetDeviceId) {
            removeFile(device, targetDeviceId);
        }
        else if (cmd == "arp -a"){
            displayARPTable(device);
        }
        else {
            displayOutput(`Unknown Command: ${command}`);
        }
    }
    function removeFile(device, fileName) {
        const files = device.files || [];
        const fileIndex = files.findIndex(file => file.name === fileName);
        if (fileIndex !== -1) {
            files.splice(fileIndex, 1);
            displayOutput(`File "${fileName}" removed from device ${device.id}.`);
        } else {
            displayOutput(`File "${fileName}" not found on device ${device.id}.`);
        }
    }
    function setIpAddressWithSubnet(device, ipAddress, subnetMask = '0.0.0.0') {
       
        const deviceType = device.classList[1];
        const restrictedTypes = ['switch', 'firewall', 'encript', 'wpa-psk', 'multi-switch', 'hub'];
        
        if (restrictedTypes.includes(deviceType)) {
            displayOutput(`Cannot set IP address and subnet mask for device type ${deviceType}.`);
            return;
        }
    
        
        const existingDevices = document.querySelectorAll(".device");
        for (let i = 0; i < existingDevices.length; i++) {
            const existingDevice = existingDevices[i];
            if (existingDevice !== device) {
                const existingIpAddress = getIpAddress(existingDevice);
                if (existingIpAddress === ipAddress) {
                    displayOutput(`IP address ${ipAddress} is already in use by device ${existingDevice.id}.`);
                    return;
                }
            }
        }
    
       
        const ipAddressElement = device.querySelector(".ip-address");
        if (ipAddressElement) {
            ipAddressElement.innerText = ipAddress;
        } else {
            const newIpAddressElement = document.createElement("div");
            newIpAddressElement.classList.add("ip-address");
            newIpAddressElement.innerText = ipAddress;
            device.appendChild(newIpAddressElement);
        }
    
        
        device.setAttribute("subnet-mask", subnetMask);
    

        displayOutput(`IP address ${ipAddress} with subnet mask ${subnetMask} set for device ${device.id}.`);
    }
    
    function downloadFTPFile(sourceDevice, targetDeviceId, fileName) {
        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            displayOutput(`Device with ID ${targetDeviceId} Not Found.`);
            return;
        }
    
        
        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
        const subnetMask = "255.255.255.0"; 
    
        
        if (!isSameNetwork(sourceIpAddress, targetIpAddress, subnetMask)) {
            displayOutput(`Unreachable.`);
            return;
        }

        if (targetDevice.firewallEnabled){
            displayOutput("Access denied");
            return;
        }
       
        const sourcePorts = sourceDevice.activePorts || [];
        const targetPorts = targetDevice.activePorts || [];
        if (!sourcePorts.includes(21)) {
            displayOutput(`FTP service is inactive ${sourceDevice.id}.`);
            return;
        }
        if (!targetPorts.includes(21)) {
            displayOutput(`Connection refused${targetDeviceId}.`);
            return;
        }
    

        const targetFiles = targetDevice.files || [];
        const file = targetFiles.find(f => f.name === fileName);
        if (!file) {
            displayOutput(`File "${fileName}" not found ${targetDeviceId}.`);
            return;
        }
    
        
        if (!sourceDevice.files) {
            sourceDevice.files = [];
        }
        sourceDevice.files.push(file);
    
        displayOutput(`File "${fileName}" installed Src : ${targetDeviceId} Dst : ${sourceDevice.id}.`);
    }
    function displayFTPFileList(sourceDevice, targetDeviceId) {
        
        const sourcePorts = sourceDevice.activePorts || [];
        if (!sourcePorts.includes(21)) {
            displayOutput(`FTP service is inactive ${sourceDevice.id}. Operation cannot proceed.`);
            return;
        }
    
        
        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            displayOutput(`Target device with ID ${targetDeviceId} not found.`);
            return;
        }

        
    
       
        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
        const subnetMask = "255.255.255.0"; 
    
        
        if (!isSameNetwork(sourceIpAddress, targetIpAddress, subnetMask)) {
            displayOutput(`Source and target devices are not on the same network.`);
            return;
        }

        if (targetDevice.firewallEnabled){
            displayOutput("Access denied");
            return;
        }
   
        const targetPorts = targetDevice.activePorts || [];
        if (!targetPorts.includes(21)) {
            displayOutput(`Port 21 is not active on the target device ${targetDeviceId}.`);
            return;
        }
    
        const targetFiles = targetDevice.files || [];
        displayOutput(`File list on device ${targetDeviceId}:`);
        if (targetFiles.length === 0) {
            displayOutput(`No files on device ${targetDeviceId}.`);
        } else {
            targetFiles.forEach(file => {
                displayOutput(`- ${file.name}`);
            });
        }
    }
    
    function authenticateFTP_for_download(sourceDevice, targetDevice, fileName) {
        const username = prompt("Enter FTP username:");
        const password = prompt("Enter FTP password:");
    
        
        if (!username || !password) {
            displayOutput("Username or password cannot be empty.");
            return;
        }

        if (!targetDevice.ftp || !targetDevice.ftp.username || !targetDevice.ftp.password) {
            displayOutput(`FTP authentication not set for target device ${targetDevice.id}.`);
            return;
        }
    
      
        if (username !== targetDevice.ftp.username || password !== targetDevice.ftp.password) {
            displayOutput("Invalid username or password.");
            return;
        }
    

        performFTPDownload(sourceDevice, targetDevice, fileName);
    }
    

    
    function changePortStatus(device, proto, status) {
        const portMapping = {
            'ssh': 22,
            'ftp': 21,
            'http': 80,
            'https': 443,
            'smtp': 25,
            'telnet': 23
        };
        function showDeviceInfo(event) {
            event.stopPropagation();
            
            const deviceType = this.classList[1];
            const deviceId = this.id;
            const ipAddress = getIpAddress(this) || "0.0.0.0";
           
            const activePorts = this.activePorts ? this.activePorts.join(', ') : 'No active ports';
            
            if (deviceType === 'switch' || deviceType === 'multi-switch' || deviceType === 'hub') {
                alert(`Device Type: ${deviceType}\nDevice ID: ${deviceId}\nActive Ports: ${activePorts}`);
            } else {
                alert(`Device Type: ${deviceType}\nDevice ID: ${deviceId}\nIP Address: ${ipAddress}\nActive Ports: ${activePorts}`);
            }
        }
        const port = portMapping[proto.toLowerCase()];
        if (port === undefined) {
            displayOutput(`Unknown protocol: ${proto}`);
            return;
        }
    
        if (status.toLowerCase() === 'start') {
            if (!device.activePorts.includes(port)) {
                device.activePorts.push(port);
                displayOutput(`Port ${port} (${proto.toUpperCase()}) is now active on device ${device.id}.`);
            } else {
                displayOutput(`Port ${port} (${proto.toUpperCase()}) is already active on device ${device.id}.`);
            }
        } else if (status.toLowerCase() === 'stop') {
            const index = device.activePorts.indexOf(port);
            if (index !== -1) {
                device.activePorts.splice(index, 1);
                displayOutput(`Port ${port} (${proto.toUpperCase()}) is now inactive on device ${device.id}.`);
            } else {
                displayOutput(`Port ${port} (${proto.toUpperCase()}) is already inactive on device ${device.id}.`);
            }
        } else {
            displayOutput(`Invalid status: ${status}`);
        }
    }
    
    
    function displayARPTable(device) {
        
        const arpTable = device.arpTable || [];
        
        displayOutput(`ARP Table for ${device.id}:`);
        if (arpTable.length === 0) {
            displayOutput(`No ARP entries found.`);
        } else {
            arpTable.forEach((entry) => {
                
                displayOutput(`IP Address: ${entry.ip}, MAC Address: ${entry.mac}`);
            });
        }
    }
    function executeNSLookup(device, args) {
        if (!args[1]) {
            displayOutput("Invalid arguments for nslookup. Please provide a hostname or IP address.");
            return;
        }
    
        const query = args[1].trim(); 
    
        
        const defaultServer = getIpAddress(device) || "0.0.0.0";
    
        
        let result;
        if (query.includes('.')) {
            
            result = `Name: ${query}\nAddress: ${defaultServer}`;
        } else {
          
            result = `Name: [Domain for IP not found]\nAddress: ${query}`;
        }
    
        displayOutput(`Server: ${defaultServer}\n${result}`);
    }
    function executeFTP(sourceDevice, targetDeviceId, fileName) {
        
        const sourcePorts = sourceDevice.activePorts || [];
        if (!sourcePorts.includes(21)) {
            displayOutput(`FTP service inactive.`);
            return;
        }

        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            displayOutput(`Target device ${targetDeviceId} not found.`);
            return;
        }
    
        const targetPorts = targetDevice.activePorts || [];
        if (!targetPorts.includes(21)) {
            displayOutput(`Target device ${targetDeviceId} does not have port 21 active.`);
            return;
        }

        if (targetDevice.firewallEnabled){
            displayOutput("Access denied");
            return;
        }

        if (targetDevice.firewallEnabled) {
            displayOutput(`Firewall is active on target device ${targetDeviceId}.`);
            return;
        }
    

        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
        const subnetMask = "255.255.255.0";
        if (!isSameNetwork(sourceIpAddress, targetIpAddress, subnetMask)) {
            displayOutput(`Source and target devices are not in the same network.`);
            return;
        }
    
    
        const sourceFiles = sourceDevice.files || [];
        const file = sourceFiles.find(f => f.name === fileName);
        if (!file) {
            displayOutput(`File "${fileName}" not found in source device.`);
            return;
        }
    

        simulateFTPOperation(sourceDevice, targetDevice, fileName);
    }
    
    function simulateFTPOperation(sourceDevice, targetDevice, fileName) {
      
        if (!targetDevice.files) {
            targetDevice.files = [];
        }
        
        const newFile = {
            name: fileName,
            size: Math.floor(Math.random() * 1024), 
            dateModified: new Date()
        };

    targetDevice.files.push(newFile);
    displayOutput(`File "${fileName}" has been sent to device ${targetDevice.id} via FTP.`);
}
    function executeMITM(device, sourceDeviceId, targetDeviceId) {
        const sourceDevice = document.getElementById(sourceDeviceId);
        const targetDevice = document.getElementById(targetDeviceId);
        
        if (!sourceDevice || !targetDevice) {
            displayOutput(`Source or target device not found.`);
            return;
        }
    
       
        const mitmPorts = device.activePorts || [];
        if (!mitmPorts.includes(80) && !mitmPorts.includes(443)) {
            displayOutput(`The MITM device does not have the necessary ports (80/443) active.`);
            return;
        }
    
       
        device.mitmMode = true;
        device.sourceDevice = sourceDeviceId;
        device.targetDevice = targetDeviceId;
    
        displayOutput(`MITM attack initiated. Device ${device.id} is monitoring traffic between ${sourceDeviceId} and ${targetDeviceId}.`);
    
        monitorTraffic(device, sourceDevice, targetDevice);
    }
    
    function monitorTraffic(device, sourceDevice, targetDevice) {
      
        displayOutput(`Monitoring traffic between ${sourceDevice.id} and ${targetDevice.id}.`);
    }
    function sniffPort(targetDeviceId) {
        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            displayOutput(`Perangkat dengan ID ${targetDeviceId} tidak ditemukan.`);
            return;
        }
    
       
        const activePorts = targetDevice.activePorts || [];
    
     
        if (activePorts.length > 0) {
            activePorts.forEach(port => {
                displayOutput(`Port ${port} Up`);
            });
        } else {
            displayOutput(`Tidak ada port aktif pada perangkat ${targetDeviceId}.`);
        }
    }
    
    function displayNetstat(device) {
       
        const allPorts = [21, 22, 23 , 80, 443, 25]; 
        
        
        const activePorts = device.activePorts || [];
    
        
        displayOutput(`Netstat Detail ${device.id}:`);
    
        
        allPorts.forEach(port => {
            if (activePorts.includes(port)) {
                
                displayOutput(`- Port ${port} Up`);
            } else {
                
                displayOutput(`- Port ${port} Down`);
            }
        });
    }
    
    
    
    function displayFirewallStatus(device) {
        const firewallStatus = device.firewallEnabled ? "on" : "off";
        const color = device.firewallEnabled ? "green" : "red";
    
        
        const cliWindow = document.getElementById("cliWindow");
        const outputLine = document.createElement("div");
        outputLine.textContent = `Firewall status: ${firewallStatus.toUpperCase()}`;
        outputLine.style.color = color; 
        cliWindow.appendChild(outputLine);
        cliWindow.scrollTop = cliWindow.scrollHeight;
    }
    
    function executeSSH(sourceDevice, targetDeviceId) {
        const targetDevice = document.getElementById(targetDeviceId);
    
        if (!targetDevice) {
            displayOutput(`Cannot find device ${targetDeviceId}.`);
            return;
        }
    
        
        const sourcePorts = sourceDevice.activePorts || [];
        const targetPorts = targetDevice.activePorts || [];
        
        if (!sourcePorts.includes(22)) {
            displayOutput(`Can not create connection by ${sourceDevice.id}.`);
            return;
        }
        if (!targetPorts.includes(22)) {
            displayOutput(`Connection refused by ${targetDevice.id}.`);
            return;
        }
    
       
        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
        const subnetMask = "255.255.255.0";
    
        if (!isSameNetwork(sourceIpAddress, targetIpAddress, subnetMask)) {
            displayOutput(`Unreachable source: ${sourceDevice.id} to destination: ${targetDeviceId}.`);
            return;
        }
    
       
        if (targetDevice.firewallEnabled) {
            displayOutput(`Connection refised ${targetDevice.id}.`);
            return;
        }
    
        
        displayOutput(`Connected to ${targetDevice.id} from ${sourceDevice.id}.`);
    
        
        createSSHCLI(targetDevice);
    }
    
    
    function createSSHCLI(targetDevice) {
        
        const cliWindow = document.createElement("div");
        cliWindow.id = `sshCLIWindow-${targetDevice.id}`;
        cliWindow.style.width = "600px";
        cliWindow.style.height = "500px";
        cliWindow.style.overflowY = "auto";
        cliWindow.style.border = "1px solid #333";
        cliWindow.style.position = "absolute";
        cliWindow.style.top = "10%";
        cliWindow.style.left = "10%";
        cliWindow.style.backgroundColor = "#000";
        cliWindow.style.color = "#fff";
        cliWindow.style.cursor = "move";
        document.body.appendChild(cliWindow);
    
        
        const closeButton = document.createElement("button");
        closeButton.innerText = "Close";
        closeButton.style.backgroundColor = "#444";
        closeButton.style.color = "#fff";
        closeButton.style.margin = "10px";
    
       
        closeButton.addEventListener("click", function () {
            cliWindow.remove(); 
        });
    
        
        cliWindow.appendChild(closeButton);
    
        
        setPromptForSSH(targetDevice, cliWindow);
    
     
        makeCLIWindowDraggable(cliWindow);
    }
    
    function setPromptForSSH(device, cliWindow) {
        
        const cliLine = document.createElement("div");
        cliLine.style.display = "flex";
        
        const promptElement = document.createElement("div");
        promptElement.textContent = `C:\\${device.id}> `;
        promptElement.style.color = "#fff";
        promptElement.style.marginRight = "5px";
    
        const inputElement = document.createElement("input");
        inputElement.id = `sshCLIInput-${device.id}`;
        inputElement.style.backgroundColor = "black";
        inputElement.style.color = "#fff";
        inputElement.style.width = "calc(100% - promptElement.offsetWidth)";
        inputElement.style.border = "none";
        inputElement.style.outline = "none";
    
       
        inputElement.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                const command = inputElement.value.trim();
                if (command) {
                    executeCommand(device, command, cliWindow); 
                    inputElement.value = ''; 
                    setPromptForSSH(device, cliWindow); 
                }
            }
        });
    
  
        cliLine.appendChild(promptElement);
        cliLine.appendChild(inputElement);
        cliWindow.appendChild(cliLine);
        cliWindow.scrollTop = cliWindow.scrollHeight;
    
      
        inputElement.focus();
    }
    
    function makeFile(device, fileName) {
      
        if (!device.files) {
            device.files = [];
        }
    
      
        const existingFile = device.files.find(file => file.name === fileName);
        if (existingFile) {
            displayOutput(`File "${fileName}" Created ${device.id}.`);
        } else {
            const newFile = {
                name: fileName,
                size: 0,
                dateModified: new Date()
            };
            device.files.push(newFile);
            displayOutput(`File "${fileName}" Created ${device.id}.`);
        }
    }
    
    function displayDir(device) {
        
        if (!device.files || device.files.length === 0) {
            displayOutput(`File Is Empty ${device.id}.`);
            return;
        }
    
        
        displayOutput(`Directory of C:\\${device.id}`);
        displayOutput("");
    
        
        device.files.forEach(file => {
            const date = file.dateModified.toLocaleDateString(); 
            const fileName = file.name; 
            displayOutput(`${date} ${fileName}`);
        });
    
        
        displayOutput("");
    }
    function displayIpConfig(device) {
        const ipAddress = getIpAddress(device) || '0.0.0.0';
        const subnetMask = device.getAttribute("subnet-mask") || '0.0.0.0';
        const gateway = device.getAttribute("gateway") || '0.0.0.0';
    
        
        const ipConfigOutput = `Ethernet adapter ${device.id}:
    
       \nConnection-specific DNS Suffix  . : 
       \nLink-local IPv6 Address . . . . . : \n
       \nIPv4 Address. . . . . . . . . . . : ${ipAddress}\n
       \nSubnet Mask . . . . . . . . . . . : ${subnetMask}\n
       \nDefault Gateway . . . . . . . . . : ${gateway}
    `;
    
        // Tampilkan keluaran
        displayOutput(ipConfigOutput);
    }
    
    function executePing(device, targetDeviceId) {
        
        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            displayOutput(`Perangkat tujuan dengan ID ${targetDeviceId} tidak ditemukan.`);
            return;
        }
    
        const isSelfPing = targetDevice === device;


        if (targetDevice.firewallEnabled && !isSelfPing) {
           
            for (let i = 1; i <= 5; i++) {
                setTimeout(() => {
                    displayOutput(`Request timed out`);
                }, i * 1000);
            }
            return;
        }
    
        
        const targetIp = getIpAddress(targetDevice);
        if (!targetIp) {
            displayOutput(`Dst ${targetDeviceId} dont have ip address.`);
            return;
        }
    
        const sourceIp = getIpAddress(device);
        const subnetMask = "255.255.255.0";
    
        if (isSameNetwork(sourceIp, targetIp, subnetMask)) {
           
            for (let i = 1; i <= 5; i++) {
                setTimeout(() => {
                    const time = Math.floor(Math.random() * 100);
                    displayOutput(`Reply from ${targetIp}: bytes=32 time=${time}ms TTL=64`);
                }, i * 1000);
            }
        } else {
            
            for (let i = 1; i <= 5; i++) {
                setTimeout(() => {
                    displayOutput(`Destination Unreachable from ${sourceIp} to ${targetIp}`);
                }, i * 1000);
            }
        }
    }
    

    function addGateway() {
        
        const deviceId = prompt("Masukkan ID perangkat:");
        if (!deviceId) {
            alert("ID perangkat tidak valid.");
            return;
        }
        const device = document.getElementById(deviceId);
        if (!device) {
            alert("Perangkat tidak ditemukan.");
            return;
        }
        const gateway = prompt("Masukkan alamat gateway:");
        if (!gateway) {
            alert("Alamat gateway tidak valid.");
            return;
        }
        device.gateway = gateway;
        alert(`Gateway ${gateway} telah ditetapkan ke perangkat ${deviceId}.`);
    }
    addgate.addEventListener("click",function(){
        addGateway();
    });
    addmodem.addEventListener("click",function(){
        addDevice("modem");
    });
    addip.addEventListener("click", function() {
        const deviceId = prompt("Masukkan ID perangkat:");
        if (!deviceId) return; 
        const device = document.getElementById(deviceId);
        if (!device) {
            alert("Perangkat tidak ditemukan.");
            return;
        }
        const ipAddress = prompt("Masukkan alamat IP:");
        addIpAddress(device, ipAddress);
    });
    function addIpAddress(device, ipAddress) {
        const deviceType = device.classList[1];
        const restrictedTypes = ['switch', 'firewall', 'encript','wpa-psk','multi-switch','hub'];
        if (restrictedTypes.includes(deviceType)) {
            alert(`Can not use ip address ${deviceType} .`);
            return;
        }
        const existingDevices = document.querySelectorAll(".device");
        for (let i = 0; i < existingDevices.length; i++) {
            const existingDevice = existingDevices[i];
            if (existingDevice !== device) {
                const existingIpAddress = getIpAddress(existingDevice);
                if (existingIpAddress && existingIpAddress === ipAddress) {
                    alert(`IP Address ${ipAddress} allready used ${existingDevice.id}.`);
                    return; 
                }
            }
        }
        const ipAddressElement = document.createElement("div");
        ipAddressElement.classList.add("ip-address");
        ipAddressElement.innerText = ipAddress;
        device.appendChild(ipAddressElement);
        device.ipAddress = ipAddress;
    }
    function getIpAddress(device) {
        const ipAddressElement = device.querySelector(".ip-address");
        return ipAddressElement ? ipAddressElement.innerText : "0.0.0.0";
    }
    function updateDeviceInfo(device) {
        const deviceType = device.classList[1];
        const deviceId = device.id;
        const ipAddress = getIpAddress(device);
        alertInfo(deviceType, deviceId, ipAddress);
    }
    addmul.addEventListener("click",function(){
        addDevice("multi-switch");
    });
    addrepeat.addEventListener("click",function(){
        addDevice("repeater")
    });
    addwifirouter.addEventListener("click",function(){
        addDevice("wifi-router");
    });
    addhub.addEventListener("click",function(){
        addDevice("hub");
    });
    
    
    addencript.addEventListener("click",function(){
        addDevice("encript");
    });
    addWPAButton.addEventListener("click", function() {
        
        const deviceId = prompt("Masukkan ID perangkat:");
        if (!deviceId) {
            alert("ID perangkat tidak valid.");
            return;
        }
        const device = document.getElementById(deviceId);
        if (!device) {
            alert("Perangkat tidak ditemukan.");
            return;
        }
        if (!device.classList.contains("wifi-router") && 
            !device.classList.contains("access-point") && 
            !device.classList.contains("repeater")) {
            alert("Perangkat tidak mendukung WPA-PSK.");
            return;
        }
        const password = prompt("Masukkan kata sandi WPA:");
        if (!password) {
            alert("Kata sandi tidak valid.");
            return;
        }
        
      
        device.wpaPassword = password;
        alert(`Kata sandi WPA telah diatur untuk perangkat ${deviceId}.`);
    });
    addfirewall.addEventListener("click",function(){
        addDevice("firewall");
    });
   
    addphone.addEventListener("click",function(){
        addDevice("phone");
    });
    addprinter.addEventListener("click",function(){
        addDevice("printer");
    });
    addisp.addEventListener("click",function(){
        addDevice("isp");
    });
    addserver.addEventListener("click",function(){
        addDevice("server");
    });
    addRouterBtn.addEventListener("click", function() {
        addDevice("router");
    });

    addSwitchBtn.addEventListener("click", function() {
        addDevice("switch");
    });

    addPCBtn.addEventListener("click", function() {
        addDevice("pc");
    });
    addfileserver.addEventListener("click", function(){
        addDevice("file-server");
    });
    addLaptopBtn.addEventListener("click", function() {
        addDevice("laptop");
    });

    addAccessPointBtn.addEventListener("click", function() {
        addDevice("access-point");
    });
    const addDashedConnectionBtn = document.getElementById("addDashedConnectionBtn");
    const addcoaxial = document.getElementById("addCoaxial")
    const addwire = document.getElementById("addwire")

    addwire.addEventListener("click", function() {
        
        isCoaxialConnectionMode = !isCoaxialConnectionMode;
    
        if (isCoaxialConnectionMode) {
            
            alert("Mode koneksi koaksial diaktifkan. Klik perangkat sumber dan perangkat tujuan untuk menghubungkannya.");
            document.body.style.cursor = "pointer"; 
        } else {
          
            alert("Mode koneksi koaksial dinonaktifkan.");
            document.body.style.cursor = "default"; 
            selectedCoaxialSourceDevice = null; 
            selectedCoaxialTargetDevice = null; 
        }
    });
    devicesContainer.addEventListener("click", function(event) {
   
        if (isCoaxialConnectionMode) {

            const clickedElement = event.target.closest(".device");
            
            if (clickedElement) {
 
                if (!selectedCoaxialSourceDevice) {
                    selectedCoaxialSourceDevice = clickedElement;
                    alert(`Perangkat sumber yang dipilih: ${clickedElement.id}`);
                } else if (!selectedCoaxialTargetDevice && clickedElement !== selectedCoaxialSourceDevice) {
                   
                    selectedCoaxialTargetDevice = clickedElement;
                    alert(`Perangkat tujuan yang dipilih: ${clickedElement.id}`);
                    
                    if (selectedCoaxialSourceDevice && selectedCoaxialTargetDevice) {
                        connectCoaxialDevices(selectedCoaxialSourceDevice, selectedCoaxialTargetDevice);
                        
                 
                        isCoaxialConnectionMode = false;
                        selectedCoaxialSourceDevice = null;
                        selectedCoaxialTargetDevice = null;
                        document.body.style.cursor = "default"; 
                    }
                }
            }
        }
    });

    addcoaxial.addEventListener("click", function() {
        
        const sourceDeviceId = prompt("Masukkan ID perangkat sumber:");
        if (!sourceDeviceId) return;
        const sourceDevice = document.getElementById(sourceDeviceId);
        if (!sourceDevice) {
            alert("Perangkat sumber tidak ditemukan.");
            return;
        }
    
        
        const targetDeviceId = prompt("Masukkan ID perangkat tujuan:");
        if (!targetDeviceId) return;
        const targetDevice = document.getElementById(targetDeviceId);
        if (!targetDevice) {
            alert("Perangkat tujuan tidak ditemukan.");
            return;
        }
        
       
        if (!sourceDevice.classList.contains("wifi-router") && !sourceDevice.classList.contains("access-point") && !sourceDevice.classList.contains("repeater") && !sourceDevice.classList("pc") && !sourceDevice.classList("phone") && !sourceDevice.classList("laptop")) {
            alert("Perangkat sumber tidak mendukung koneksi nirkabel.");
            return;
        }
        
        
        const inputPassword = prompt("Masukkan kata sandi WPA:");
        if (!inputPassword) {
            alert("Kata sandi tidak valid.");
            return;
        }
        
      
        if (!checkWPA(sourceDevice, inputPassword)) {
            alert("Kata sandi WPA tidak cocok. Koneksi tidak dapat dilanjutkan.");
            return;
        }
        
        
        const color = document.getElementById("lineColor").value;
        const width = document.getElementById("lineWidth").value;
        addzigzagconnection(sourceDevice, targetDevice, color, width);
    });
    let isDashedConnectionMode = false; 
    let selectedDashedSourceDevice = null; 
    addDashedConnectionBtn.addEventListener("click", function () {
       
        isDashedConnectionMode = !isDashedConnectionMode;
    
        if (isDashedConnectionMode) {
            
            alert("Mode koneksi putus-putus diaktifkan. Klik perangkat sumber dan perangkat tujuan untuk menghubungkannya.");
            document.body.style.cursor = "pointer"; 
        } else {
            
            alert("Mode koneksi putus-putus dinonaktifkan.");
            document.body.style.cursor = "default"; 
            selectedDashedSourceDevice = null; 
            selectedDashedTargetDevice = null;
        }
    });
    function connectDashedDevices(sourceDevice, targetDevice) {
        
        const startX = sourceDevice.offsetLeft + sourceDevice.offsetWidth / 2;
        const startY = sourceDevice.offsetTop + sourceDevice.offsetHeight / 2;
        const endX = targetDevice.offsetLeft + targetDevice.offsetWidth / 2;
        const endY = targetDevice.offsetTop + targetDevice.offsetHeight / 2;
    
        
        drawDashedLine(startX, startY, endX, endY);
        
        
    }
    function drawDashedLine(startX, startY, endX, endY, color = "black", width = 4, dashLength = [5, 5]) {
        const ctx = canvas.getContext("2d");
        
        
        ctx.strokeStyle = color;
        ctx.lineWidth = width;
        ctx.setLineDash(dashLength); 
        

        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(endX, endY);
        ctx.stroke();
        ctx.closePath();
        
        
        ctx.setLineDash([]);
    }
    let selectedDashedTargetDevice = false;

    devicesContainer.addEventListener("click", function (event) {

        if (isDashedConnectionMode) {
            
            const clickedElement = event.target.closest(".device");
            
            if (clickedElement) {
                
                if (!selectedDashedSourceDevice) {
                    selectedDashedSourceDevice = clickedElement;
                   
                } else if (!selectedDashedTargetDevice && clickedElement !== selectedDashedSourceDevice) {
                    
                    selectedDashedTargetDevice = clickedElement;
                  
                    
                    
                    if (selectedDashedSourceDevice && selectedDashedTargetDevice) {
                        connectDashedDevices(selectedDashedSourceDevice, selectedDashedTargetDevice);
                        
                       
                        isDashedConnectionMode = false;
                        selectedDashedSourceDevice = null;
                        selectedDashedTargetDevice = null;
                        document.body.style.cursor = "default"; 
                    }
                }
            }
        }
    });
    /**
     * 
     * @param {*} device1 
     * @param {*} device2 
     * @param {*} color 
     * @param {*} width 
     */
    function drawCoaxialLine(startX, startY, endX, endY, color = "black", width = 5) {
        const ctx = canvas.getContext("2d");

        ctx.strokeStyle = color;
        ctx.lineWidth = width;
        ctx.setLineDash([5, 5]); 
    
        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(endX, endY);
        ctx.stroke();
        ctx.closePath();
    
        
        ctx.setLineDash([]);
    }
    let isCoaxialConnectionMode = false; 
    let selectedCoaxialSourceDevice = null; 
    let selectedCoaxialTargetDevice = null;
    function drawLightningLine(startX, startY, endX, endY, color = "blue", width = 5) {
        const ctx = canvas.getContext("2d");
    
      
        const length = Math.sqrt((endX - startX) ** 2 + (endY - startY) ** 2);
        const numSegments = Math.floor(length / 10); 
        
     
        const dx = (endX - startX) / numSegments;
        const dy = (endY - startY) / numSegments;
    
      
        ctx.strokeStyle = color;
        ctx.lineWidth = width;
        
        ctx.beginPath();
        ctx.moveTo(startX, startY);
    
        for (let i = 0; i <= numSegments; i++) {
            const x1 = startX + dx * i;
            const y1 = startY + dy * i;
    
            
            const x2 = x1 + (i % 2 === 0 ? dx / 2 : -dx / 2);
            const y2 = y1 + (i % 2 === 0 ? dy / 2 : -dy / 2);
            
            ctx.lineTo(x2, y2);
        }
    
        ctx.lineTo(endX, endY);
        ctx.stroke();
        ctx.closePath();
    }
    
    function connectCoaxialDevices(sourceDevice, targetDevice) {
    
        const startX = sourceDevice.offsetLeft + sourceDevice.offsetWidth / 2;
        const startY = sourceDevice.offsetTop + sourceDevice.offsetHeight / 2;
        const endX = targetDevice.offsetLeft + targetDevice.offsetWidth / 2;
        const endY = targetDevice.offsetTop + targetDevice.offsetHeight / 2;
    
        
        drawLightningLine(startX, startY, endX, endY);
    
        alert(`Perangkat ${sourceDevice.id} dan ${targetDevice.id} telah dihubungkan dengan garis koaksial.`);
    }
    function drawCoaxialLine(startX, startY, endX, endY, color = "blue ", width = 5) {
        const ctx = canvas.getContext("2d");
        
        ctx.strokeStyle = color;
        ctx.lineWidth = width;
        ctx.setLineDash([5, 5]); 
    
        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(endX, endY);
        ctx.stroke();
        ctx.closePath();
    

        ctx.setLineDash([]);
    }
    
    function addDashedConnection(device1, device2, color, width) {
        const startX = device1.offsetLeft + device1.offsetWidth / 2;
        const startY = device1.offsetTop + device1.offsetHeight / 2;
        const endX = device2.offsetLeft + device2.offsetWidth / 2;
        const endY = device2.offsetTop + device2.offsetHeight / 2;

    
        const length = Math.sqrt((endX - startX) ** 2 + (endY - startY) ** 2);

    
        const numSegments = Math.floor(length / 10);

    
        const dx = (endX - startX) / numSegments;
        const dy = (endY - startY) / numSegments;

    
        for (let i = 0; i < numSegments; i++) {
            const x1 = startX + dx * i;
            const y1 = startY + dy * i;
            const x2 = startX + dx * (i + 0.5);
            const y2 = startY + dy * (i + 0.5);
            drawLine(x1, y1, x2, y2, color, width);
    }
}
    /**
     * 
     * @param {*} device1 
     * @param {*} device2 
     * @param {*} color 
     * @param {*} width 
     */
    function addwirelessconnection(device1, device2, color, width) {
        const startX = device1.offsetLeft + device1.offsetWidth / 2;
        const startY = device1.offsetTop + device1.offsetHeight / 2;
        const endX = device2.offsetLeft + device2.offsetWidth / 2;
        const endY = device2.offsetTop + device2.offsetHeight / 2;

        
        drawWave(startX, startY, endX, endY, color, width);

        
    }
    /**
     * 
     * @param {*} startX 
     * @param {*} startY 
     * @param {*} endX 
     * @param {*} endY 
     * @param {*} color 
     * @param {*} width 
     */
    function drawWave(startX, startY, endX, endY, color, width) {
        const context = canvas.getContext("2d");
        const controlX = (startX + endX) / 2;
        const controlY = (startY + endY) / 2 - 50;
    
       
        context.beginPath();
        context.moveTo(startX, startY);
        context.quadraticCurveTo(controlX, controlY, endX, endY);
        context.strokeStyle = 'black'; 
        context.lineWidth = width;
        context.stroke();
        context.closePath();
    
        
        setTimeout(() => {
            context.beginPath();
            context.moveTo(startX, startY);
            context.quadraticCurveTo(controlX, controlY, endX, endY);
            context.strokeStyle = "blue"; 
            context.lineWidth = width;
            context.stroke();
            context.closePath();
        }, 4000); 
    }
    
    function createTCPConnection(sourceDevice, targetDevice) {
       
        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
    
        if (!sourceIpAddress || sourceIpAddress === '0.0.0.0') {
            alert("Perangkat sumber belum memiliki alamat IP.");
            return;
        }
    
        if (!targetIpAddress || targetIpAddress === '0.0.0.0') {
            alert("Perangkat tujuan belum memiliki alamat IP.");
            return;
        }
    
       
        const connectionEstablished = simulateTCPConnection(sourceDevice, targetDevice);
    
        if (connectionEstablished) {
            alert(`Koneksi TCP berhasil dibuat antara ${sourceIpAddress} dan ${targetIpAddress}`);
        } else {
            alert(`Gagal membuat koneksi TCP antara ${sourceIpAddress} dan ${targetIpAddress}`);
        }
    }
    function simulateTCPConnection(sourceDevice, targetDevice) {
      
        const subnetMask = "255.255.255.0"; 
    
        const sourceIpAddress = getIpAddress(sourceDevice);
        const targetIpAddress = getIpAddress(targetDevice);
    
    
        return isSameNetwork(sourceIpAddress, targetIpAddress, subnetMask);
    }
    const createTCPConnectionBtn = document.getElementById("createTCPConnectionBtn");
    createTCPConnectionBtn.addEventListener("click", function() {
    const sourceDeviceId = prompt("Masukkan ID perangkat sumber:");
    if (!sourceDeviceId) return;
    const sourceDevice = document.getElementById(sourceDeviceId);
    if (!sourceDevice) {
        alert("Perangkat sumber tidak ditemukan.");
        return;
    }

    const targetDeviceId = prompt("Masukkan ID perangkat tujuan:");
    if (!targetDeviceId) return;
    const targetDevice = document.getElementById(targetDeviceId);
    if (!targetDevice) {
        alert("Perangkat tujuan tidak ditemukan.");
        return;
    }

    
    createTCPConnection(sourceDevice, targetDevice);
});
    /**
     * 
     * @param {*} device1 
     * @param {*} device2 
     * @param {*} color 
     * @param {*} width 
     */
    function addzigzagconnection(device1, device2, color, width){
        const startX = device1.offsetLeft + device1.offsetWidth / 2;
        const startY = device1.offsetTop + device1.offsetHeight / 2;
        const endX = device2.offsetLeft + device2.offsetWidth / 2;
        const endY = device2.offsetTop + device2.offsetHeight / 2;

        
        const length = Math.sqrt((endX - startX) ** 2 + (endY - startY) ** 2);

        
        const numSegments = Math.floor(length / 20); 

        
        const dx = (endX - startX) / numSegments;
        const dy = (endY - startY) / numSegments;

        
        for (let i = 0; i < numSegments; i++) {
            const x1 = startX + dx * i;
            const y1 = startY + dy * i;
            
        
            const x2 = x1 + dx / 2;
            const y2 = y1 + (i % 2 === 0 ? dy : -dy) / 2;             
        
            drawLine(x1, y1, x2, y2, color, width);
        }
    }



    
});

