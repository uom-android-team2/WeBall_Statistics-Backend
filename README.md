# WeBall Statistics

<h4>The WeBall Statistics application is a league statistics application for basketball, which was created as part of the course "Apps development for Mobile Devices" (University of Macedonia - Applied Informatics, academic year 2021-2022, 6th semester).</h4>
<h4>Part of the course, was to get organized into groups of 10 people. Our team (#Team 2) consists of the following students alphabetically:</h4>
<ul>
  <li><b><i>Ampatzidou Elisavet</i></b></li>
  <li><b><i>Charakopoulos Minas - Theodoros</i></b></li>
  <li><b><i>Dasyra Evmorfia - Elpida </i></b></li>
  <li><b><i>Iordanou Sofia</i></b></li>
  <li><b><i>Lougaris Dionisis </i></b></li>
  <li><b><i>Lousta Aravella</i></b></li>
  <li><b><i>Machairas Panagiotis</i></b></li>
  <li><b><i>Ouzounidis Kyriakos</i></b></li>
  <li><b><i>Pepa Leonard</i></b></li>
  <li><b><i>Stefou George-John</i></b></li>
</ul>

<h4>Video presentation of the app on YouTube: <a href="https://www.youtube.com/watch?v=ouzMwkUCQ-s&list=LL&index=12"><b><i>presentation video</i></b><a/></h4>
<h4>Visit the other repo, with the android mobile application: <a href="https://github.com/uom-android-team2/WeBall_Statistics"><b><i>Android App - Front-End</i></b><a/></h4>
  
# Prerequisites
<ul>
  <li>Android Studio</li>
  <li>XAMPP Control Panel</li>
  <li>An emulator installed e.g. Nexus 5 API 30, Pixel 3 XL API 29</li>
  <li>Internet Connection</li>
</ul>

# Local Installation
<h4>For the correct use of the application, the following actions are required:</h4>

```
Run at first the back-end:
git clone https://github.com/uom-android-team2/WeBall_Statistics-Backend.git or download the zip from github and extract it
Store or move the root folder WeBall_Statistics-Backend(-master) in <PATH>\xampp\htdocs folder
Open XAMPP Control Panel and start Apache and MySQL servers
Visit from your browser http://localhost/WeBall_Statistics-Backend/index/ then register or login and follow the manual

Now, for the Mobile Application:
git clone https://github.com/uom-android-team2/WeBall_Statistics.git or download the zip from github and extract it
Store or move the root folder WeBall_Statistics(-main) in <PATH>\AndroidStudioProjects\
Open Android Studio and the app root folder.
Config the App:
public static final String IP = <YOUR_IP>  --> (java/uom/team2/weball_statistics/configuration/Config.java)
<domain includeSubdomains="true"><YOUR_IP></domain>  --> (res/xml/network_security_config.xml)
Start any emulator, and then you are ready to launch the app!
```

<h4>Note: Maybe you will see already data for live matches because of the real time cloud service was used, firebase real-time database!</h4>
