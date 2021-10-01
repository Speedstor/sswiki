
<html>
<head>

</head>
<body style="background: #546686;">

    <div style="height: calc(100vh - 30px); width: 80%; max-width: 1000px; background: #e2e2e2; margin: auto; display: flex; align-items: center; justify-content: center; flex-direction: column;">
        <h1 style="font-weight: 500; text-align: center; width: 100%">AMA Drink Dispenser</h1>
        <img src="./Layer 10.png" style="height: 70vh"/>
        <p style="text-align: center; width: 100%"><small>AMA products</small></p>
        <h3>scroll down for more</h3>
    </div>

    <div style="padding: 80px; width: 100%; display: flex; justify-content: center; align-items: center; box-sizing: border-box;">
        <iframe src="https://docs.google.com/presentation/d/e/2PACX-1vSy9IiHtaDBAQvPBnhsNwG9_E3cGN_mUei0b4Bfz3ZXefSA-jZd3NsRiBTMu6BiLCdz1vZQMRVu3Dbz/embed?start=false&loop=false&delayms=3000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
    </div>

    <div style="padding: 20px; padding-bottom: 60px;width: 100%; display: flex; justify-content: center; align-items: center; box-sizing: border-box;">
        <h2 style="text-align: center; color: white;">Andrew Kim: ahk004@ucsd.edu<br/>
Marco Mendez: m5mendez@ucsd.edu<br/>
Aldrin Cheung: y1cheung@ucsd.edu<br/>
</h2>
    </div>



    <div style="display: flex; flex-direction: row; width: 100%;">
        <!-- HTML generated using hilite.me --><div style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em; margin: 20px; width: 50%;"><table><tr><td><pre style="margin: 0; line-height: 125%">  


  1
  2
  3
  4
  5
  6
  7
  8
  9
 10
 11
 12
 13
 14
 15
 16
 17
 18
 19
 20
 21
 22
 23
 24
 25
 26
 27
 28
 29
 30
 31
 32
 33
 34
 35
 36
 37
 38
 39
 40
 41
 42
 43
 44
 45
 46
 47
 48
 49
 50
 51
 52
 53
 54
 55
 56
 57
 58
 59
 60
 61
 62
 63
 64
 65
 66
 67
 68
 69
 70
 71
 72
 73
 74
 75
 76
 77
 78
 79
 80
 81
 82
 83
 84
 85
 86
 87
 88
 89
 90
 91
 92
 93
 94
 95
 96
 97
 98
 99
100
101
102
103
104
105
106
107
108
109
110
111
112
113
114
115
116
117
118
119
120
121
122
123
124
125
126
127
128
129
130
131
132
133
134
135
136
137
138
139
140
141
142
143
144
145
146
147
148
149
150
151
152
153
154
155
156
157
158
159
160
161
162
163
164
165
166
167
168
169
170
171
172
173
174
175
176
177
178
179
180
181
182
183
184
185
186
187
188
189
190
191
192
193
194
195
196
197
198
199
200
201
202
203
204
205
206
207
208
209
210
211
212
213
214
215
216
217
218
219
220
221
222
223
224
225
226
227
228
229
230
231
232
233
234
235
236
237
238
239
240
241
242
243
244
245
246
247
248
249</pre></td><td><pre style="margin: 0; line-height: 125%">
<big><b>Circuit Python Code (Metro M0 Board)</b></big>


<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">time</span> <span style="color: #008800; font-weight: bold">import</span> sleep, monotonic
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">board</span>
<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">pulseio</span> <span style="color: #008800; font-weight: bold">import</span> PWMOut
<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">digitalio</span> <span style="color: #008800; font-weight: bold">import</span> DigitalInOut, Direction, Pull
<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">analogio</span> <span style="color: #008800; font-weight: bold">import</span> AnalogIn, AnalogOut
<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">adafruit_motor</span> <span style="color: #008800; font-weight: bold">import</span> servo
<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">adafruit_hcsr04</span> <span style="color: #008800; font-weight: bold">import</span> HCSR04
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">supervisor</span> 

spin <span style="color: #333333">=</span> PWMOut(board<span style="color: #333333">.</span>D0, duty_cycle<span style="color: #333333">=</span><span style="color: #0000DD; font-weight: bold">2</span> <span style="color: #333333">**</span> <span style="color: #0000DD; font-weight: bold">15</span>, frequency<span style="color: #333333">=</span><span style="color: #0000DD; font-weight: bold">50</span>)
serv <span style="color: #333333">=</span> servo<span style="color: #333333">.</span>Servo(spin)
cPress <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D1)
cPress<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>INPUT
cPress<span style="color: #333333">.</span>pull <span style="color: #333333">=</span> Pull<span style="color: #333333">.</span>DOWN
rgbR <span style="color: #333333">=</span> PWMOut(board<span style="color: #333333">.</span>D2, frequency<span style="color: #333333">=</span><span style="color: #0000DD; font-weight: bold">50</span>)
rgbG <span style="color: #333333">=</span> PWMOut(board<span style="color: #333333">.</span>D3, frequency<span style="color: #333333">=</span><span style="color: #0000DD; font-weight: bold">50</span>)
rgbB <span style="color: #333333">=</span> PWMOut(board<span style="color: #333333">.</span>D4, frequency<span style="color: #333333">=</span><span style="color: #0000DD; font-weight: bold">50</span>)
sonic <span style="color: #333333">=</span> HCSR04(trigger_pin<span style="color: #333333">=</span>board<span style="color: #333333">.</span>D6, echo_pin<span style="color: #333333">=</span>board<span style="color: #333333">.</span>D5)
fRed <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D7)
fYelow <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D8)
fGren <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D9)
fwhte <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D10)
fRed<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>OUTPUT
fYelow<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>OUTPUT
fGren<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>OUTPUT
fwhte<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>OUTPUT
b1 <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D11)
b2 <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D12)
b1<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>INPUT
b2<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>INPUT
b1<span style="color: #333333">.</span>pull <span style="color: #333333">=</span> Pull<span style="color: #333333">.</span>DOWN
b2<span style="color: #333333">.</span>pull <span style="color: #333333">=</span> Pull<span style="color: #333333">.</span>DOWN
d1 <span style="color: #333333">=</span> AnalogIn(board<span style="color: #333333">.</span>A3)
d2 <span style="color: #333333">=</span> AnalogIn(board<span style="color: #333333">.</span>A1)
<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">crange</span>(ip, oi, oa, ni, na):
    <span style="color: #008800; font-weight: bold">return</span> ni<span style="color: #333333">+</span>(na<span style="color: #333333">-</span>ni)<span style="color: #333333">*</span>((ip<span style="color: #333333">-</span>oi)<span style="color: #333333">*</span><span style="color: #6600EE; font-weight: bold">1.0</span><span style="color: #333333">/</span>(oa<span style="color: #333333">-</span>oi))
<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">release</span>(ifRelease):
    <span style="color: #008800; font-weight: bold">global</span> serv
    <span style="color: #008800; font-weight: bold">global</span> settedRed
    <span style="color: #008800; font-weight: bold">global</span> fRed
    <span style="color: #008800; font-weight: bold">if</span> ifRelease:
        serv<span style="color: #333333">.</span>angle <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">170</span>
        <span style="color: #008800; font-weight: bold">if</span> wLevel <span style="color: #333333">&lt;=</span> minSoic:
            fRed<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            settedRed <span style="color: #333333">=</span> <span style="color: #007020">True</span>
    <span style="color: #008800; font-weight: bold">else</span>:
        serv<span style="color: #333333">.</span>angle <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">10</span>
        <span style="color: #008800; font-weight: bold">if</span> settedRed:
            fRed<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            settedRed <span style="color: #333333">=</span> <span style="color: #007020">False</span>

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">setRgb</span>(r, g, b):
    <span style="color: #008800; font-weight: bold">global</span> rgbR
    <span style="color: #008800; font-weight: bold">global</span> rgbG
    <span style="color: #008800; font-weight: bold">global</span> rgbB
    <span style="color: #008800; font-weight: bold">if</span> settedRed:
        r <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">256</span>
        g <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
        b <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
    rgbR<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">=</span> <span style="color: #007020">round</span>(crange(r, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">65535</span>))
    rgbG<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">=</span> <span style="color: #007020">round</span>(crange(g, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">65535</span>))
    rgbB<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">=</span> <span style="color: #007020">round</span>(crange(b, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">65535</span>))

    

bAuto <span style="color: #333333">=</span> <span style="color: #007020">False</span>
singleClik <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
lock <span style="color: #333333">=</span> <span style="color: #007020">False</span>
animateBuff <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
settedRed <span style="color: #333333">=</span> <span style="color: #007020">False</span>
targetWLevel <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
wLevel <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">9</span>
clickTimeBuffer <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
downClik2Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
downClik1Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
setMaxMode <span style="color: #333333">=</span> <span style="color: #007020">False</span>
drank <span style="color: #333333">=</span> <span style="color: #007020">False</span>
minSoic <span style="color: #333333">=</span> <span style="color: #6600EE; font-weight: bold">12.5</span>
setReminderDuration <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">3</span>

musicMode <span style="color: #333333">=</span> <span style="color: #007020">False</span>
white <span style="color: #333333">=</span> AnalogOut(board<span style="color: #333333">.</span>A0)
red <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>A4)
red<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>OUTPUT
gren <span style="color: #333333">=</span> DigitalInOut(board<span style="color: #333333">.</span>D13)
gren<span style="color: #333333">.</span>direction <span style="color: #333333">=</span> Direction<span style="color: #333333">.</span>OUTPUT
timerWaterReminder <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">musicB</span>(a):
    <span style="color: #008800; font-weight: bold">global</span> white
    <span style="color: #008800; font-weight: bold">global</span> red
    <span style="color: #008800; font-weight: bold">global</span> gren
    white<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">65535</span> <span style="color: #008800; font-weight: bold">if</span> a <span style="color: #008800; font-weight: bold">else</span> <span style="color: #0000DD; font-weight: bold">0</span>
    sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)
    red<span style="color: #333333">.</span>value <span style="color: #333333">=</span> a
    sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)
    gren<span style="color: #333333">.</span>value <span style="color: #333333">=</span> a
    sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">resetAll</span>():
    <span style="color: #008800; font-weight: bold">global</span> fRed
    <span style="color: #008800; font-weight: bold">global</span> fGren
    <span style="color: #008800; font-weight: bold">global</span> fYelow
    <span style="color: #008800; font-weight: bold">global</span> bAuto
    <span style="color: #008800; font-weight: bold">global</span> red
    <span style="color: #008800; font-weight: bold">global</span> gren
    <span style="color: #008800; font-weight: bold">global</span> white
    release(<span style="color: #007020">False</span>)
    fRed<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">False</span>
    fGren<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">False</span>
    fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">False</span>
    setRgb(<span style="color: #0000DD; font-weight: bold">80</span>, <span style="color: #0000DD; font-weight: bold">80</span>, <span style="color: #0000DD; font-weight: bold">80</span>)
    bAuto <span style="color: #333333">=</span> <span style="color: #007020">False</span>

<span style="color: #008800; font-weight: bold">while</span> <span style="color: #007020">True</span>:
    <span style="color: #008800; font-weight: bold">if</span> musicMode:
        <span style="color: #008800; font-weight: bold">if</span> supervisor<span style="color: #333333">.</span>runtime<span style="color: #333333">.</span>serial_bytes_available:
            inPar <span style="color: #333333">=</span> <span style="color: #007020">input</span>()<span style="color: #333333">.</span>split(<span style="background-color: #fff0f0">&quot; &quot;</span>)
            
            <span style="color: #008800; font-weight: bold">if</span> <span style="color: #007020">len</span>(inPar) <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">10</span>:
                fRed<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">0</span>])
                fGren<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">1</span>])
                fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">2</span>])
                fwhte<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">3</span>])
                white<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">4</span>])
                red<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">5</span>])
                gren<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">6</span>])
                setRgb(<span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">7</span>]), <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">8</span>]), <span style="color: #007020">int</span>(inPar[<span style="color: #0000DD; font-weight: bold">9</span>]))

        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> b2<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> downClik2Buf <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            downClik2Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
        <span style="color: #008800; font-weight: bold">if</span> b2<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> downClik2Buf <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            downClik2Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">9999999</span>
            musicMode <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            resetAll()
            musicB(<span style="color: #007020">False</span>)
    <span style="color: #008800; font-weight: bold">else</span>:
        <span style="color: #008800; font-weight: bold">if</span> b2<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> downClik2Buf <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            downClik2Buf <span style="color: #333333">=</span> monotonic()
            singleClik <span style="color: #333333">=</span> monotonic()
        <span style="color: #008800; font-weight: bold">if</span> b1<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> downClik1Buf <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            downClik1Buf <span style="color: #333333">=</span> monotonic()

        <span style="color: #008800; font-weight: bold">if</span> downClik2Buf <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span> <span style="color: #000000; font-weight: bold">and</span> (monotonic() <span style="color: #333333">&gt;</span> downClik2Buf <span style="color: #333333">+</span> <span style="color: #0000DD; font-weight: bold">2</span>) <span style="color: #000000; font-weight: bold">and</span> downClik1Buf <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span> <span style="color: #000000; font-weight: bold">and</span> (monotonic() <span style="color: #333333">&gt;</span> downClik1Buf <span style="color: #333333">+</span> <span style="color: #0000DD; font-weight: bold">2</span>) :
            downClik2Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            downClik1Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            singleClik <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            bAuto <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            setMaxMode <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            targetWLevel <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">21</span>
            release(<span style="color: #007020">True</span>)
        <span style="color: #008800; font-weight: bold">elif</span> downClik2Buf <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span> <span style="color: #000000; font-weight: bold">and</span> (monotonic() <span style="color: #333333">&gt;</span> downClik2Buf <span style="color: #333333">+</span> <span style="color: #0000DD; font-weight: bold">2</span> <span style="color: #333333">+</span> <span style="color: #0000DD; font-weight: bold">1</span>):
            singleClik <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            musicMode <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            musicB(<span style="color: #007020">True</span>)

        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> b2<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> downClik2Buf <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            downClik2Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            <span style="color: #008800; font-weight: bold">if</span> (monotonic() <span style="color: #333333">&lt;</span> clickTimeBuffer <span style="color: #333333">+</span> <span style="color: #6600EE; font-weight: bold">0.4</span>):
                singleClik <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
                <span style="color: #008800; font-weight: bold">if</span> timerWaterReminder <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span>:
                    timerWaterReminder <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
                    fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">False</span>
                <span style="color: #008800; font-weight: bold">else</span>:
                    timerWaterReminder <span style="color: #333333">=</span> monotonic()
                    fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">True</span>
                    setReminderDuration <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">3</span>
            clickTimeBuffer <span style="color: #333333">=</span> monotonic()
        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> b1<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> downClik1Buf <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            downClik1Buf <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            <span style="color: #008800; font-weight: bold">if</span> setMaxMode:
                setMaxMode <span style="color: #333333">=</span> <span style="color: #007020">False</span>
                resetAll()
                minSoic <span style="color: #333333">=</span> targetWLevel
                targetWLevel <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>

        <span style="color: #008800; font-weight: bold">if</span> singleClik <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span> <span style="color: #000000; font-weight: bold">and</span> monotonic() <span style="color: #333333">&gt;</span> singleClik <span style="color: #333333">+</span> <span style="color: #6600EE; font-weight: bold">0.4</span> <span style="color: #000000; font-weight: bold">and</span> <span style="color: #000000; font-weight: bold">not</span> b2<span style="color: #333333">.</span>value:
            bAuto <span style="color: #333333">=</span> <span style="color: #000000; font-weight: bold">not</span> bAuto
            fGren<span style="color: #333333">.</span>value <span style="color: #333333">=</span> bAuto
            singleClik <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>

        <span style="color: #008800; font-weight: bold">try</span>: 
            wLevel <span style="color: #333333">=</span> sonic<span style="color: #333333">.</span>distance
        <span style="color: #008800; font-weight: bold">except</span>: 
            <span style="color: #008800; font-weight: bold">pass</span>

        <span style="color: #008800; font-weight: bold">if</span> setMaxMode:
            <span style="color: #008800; font-weight: bold">if</span> wLevel <span style="color: #333333">&lt;</span> targetWLevel:
                targetWLevel <span style="color: #333333">=</span> wLevel
            fRed<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            fGren<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            setRgb(<span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">0</span>)
            sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)
            <span style="color: #008800; font-weight: bold">continue</span>

        <span style="color: #008800; font-weight: bold">if</span> bAuto:
            <span style="color: #008800; font-weight: bold">if</span> cPress<span style="color: #333333">.</span>value <span style="color: #000000; font-weight: bold">and</span> <span style="color: #000000; font-weight: bold">not</span> b1<span style="color: #333333">.</span>value:
                <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> lock:
                    <span style="color: #008800; font-weight: bold">if</span> targetWLevel <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">0</span>:
                        targetWLevel <span style="color: #333333">=</span> minSoic <span style="color: #333333">+</span> ((<span style="color: #0000DD; font-weight: bold">19</span> <span style="color: #333333">-</span> minSoic) <span style="color: #333333">*</span> (<span style="color: #0000DD; font-weight: bold">1</span> <span style="color: #333333">-</span> crange(d1<span style="color: #333333">.</span>value, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">65535</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #6600EE; font-weight: bold">1.2</span>)))
                    <span style="color: #008800; font-weight: bold">print</span>(wLevel, targetWLevel)
                    <span style="color: #008800; font-weight: bold">if</span> wLevel <span style="color: #333333">&gt;</span> targetWLevel:
                        release(<span style="color: #007020">True</span>)
                        rgbR<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">10</span>
                        rgbG<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">10</span>
                        rgbB<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">=</span> rgbB<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">+</span> <span style="color: #0000DD; font-weight: bold">200</span> <span style="color: #008800; font-weight: bold">if</span> rgbB<span style="color: #333333">.</span>duty_cycle <span style="color: #333333">&lt;</span> <span style="color: #0000DD; font-weight: bold">59100</span> <span style="color: #008800; font-weight: bold">else</span> <span style="color: #0000DD; font-weight: bold">10</span>
                        sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)
                    <span style="color: #008800; font-weight: bold">else</span>:
                        release(<span style="color: #007020">False</span>)
                        <span style="color: #008800; font-weight: bold">for</span> i <span style="color: #000000; font-weight: bold">in</span> <span style="color: #007020">range</span>(<span style="color: #0000DD; font-weight: bold">4</span>):
                            setRgb(<span style="color: #0000DD; font-weight: bold">8</span>, <span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">8</span>)
                            sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)
                            setRgb(<span style="color: #0000DD; font-weight: bold">10</span>, <span style="color: #0000DD; font-weight: bold">10</span>, <span style="color: #0000DD; font-weight: bold">10</span>)
                            sleep(<span style="color: #6600EE; font-weight: bold">0.2</span>)
                        setRgb(<span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>)
                        lock <span style="color: #333333">=</span> <span style="color: #007020">True</span>
                        targetWLevel <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
            <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> cPress<span style="color: #333333">.</span>value:
                targetWLevel <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>
                lock <span style="color: #333333">=</span> <span style="color: #007020">False</span>
                setRgb(<span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>)
                <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> b1<span style="color: #333333">.</span>value:
                    release(<span style="color: #007020">False</span>)

        fwhte<span style="color: #333333">.</span>value <span style="color: #333333">=</span> cPress<span style="color: #333333">.</span>value
        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> cPress<span style="color: #333333">.</span>value:
            drank <span style="color: #333333">=</span> <span style="color: #007020">True</span>
        
        <span style="color: #008800; font-weight: bold">if</span> b1<span style="color: #333333">.</span>value:
            release(<span style="color: #007020">True</span>)
            setRgb(<span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">256</span>)
        <span style="color: #008800; font-weight: bold">else</span>:
            <span style="color: #008800; font-weight: bold">if</span> (bAuto <span style="color: #000000; font-weight: bold">and</span> lock) <span style="color: #000000; font-weight: bold">or</span> <span style="color: #000000; font-weight: bold">not</span> bAuto:
                release(<span style="color: #007020">False</span>)
                setRgb(<span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>, <span style="color: #0000DD; font-weight: bold">20</span>)

        <span style="color: #008800; font-weight: bold">if</span> timerWaterReminder <span style="color: #333333">!=</span> <span style="color: #0000DD; font-weight: bold">0</span> <span style="color: #000000; font-weight: bold">and</span> monotonic() <span style="color: #333333">&gt;</span> (timerWaterReminder <span style="color: #333333">+</span> setReminderDuration):
            <span style="color: #008800; font-weight: bold">if</span> <span style="color: #000000; font-weight: bold">not</span> drank:
                release(<span style="color: #007020">False</span>)
                <span style="color: #008800; font-weight: bold">while</span> cPress<span style="color: #333333">.</span>value:
                    setRgb(<span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">256</span>, <span style="color: #0000DD; font-weight: bold">8</span>)
                    fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">False</span>
                    sleep(<span style="color: #6600EE; font-weight: bold">0.13</span>)
                    fYelow<span style="color: #333333">.</span>value <span style="color: #333333">=</span> <span style="color: #007020">True</span>
                    setRgb(<span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">0</span>)
                    sleep(<span style="color: #6600EE; font-weight: bold">0.13</span>)
            timerWaterReminder <span style="color: #333333">=</span> monotonic()
            setRgb(<span style="color: #0000DD; font-weight: bold">80</span>, <span style="color: #0000DD; font-weight: bold">80</span>, <span style="color: #0000DD; font-weight: bold">80</span>)
            drank <span style="color: #333333">=</span> <span style="color: #007020">False</span>
</pre></td></tr></table></div>

    <!-- HTML generated using hilite.me --><div style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em; width: 50%; margin: 20px; box-sizing: border-box;"><table><tr><td><pre style="margin: 0; line-height: 125%">
    

    
  1
  2
  3
  4
  5
  6
  7
  8
  9
 10
 11
 12
 13
 14
 15
 16
 17
 18
 19
 20
 21
 22
 23
 24
 25
 26
 27
 28
 29
 30
 31
 32
 33
 34
 35
 36
 37
 38
 39
 40
 41
 42
 43
 44
 45
 46
 47
 48
 49
 50
 51
 52
 53
 54
 55
 56
 57
 58
 59
 60
 61
 62
 63
 64
 65
 66
 67
 68
 69
 70
 71
 72
 73
 74
 75
 76
 77
 78
 79
 80
 81
 82
 83
 84
 85
 86
 87
 88
 89
 90
 91
 92
 93
 94
 95
 96
 97
 98
 99
100
101
102
103
104
105
106
107
108
109
110
111
112
113
114
115
116
117
118
119
120
121
122
123
124
125
126
127
128
129
130
131
132
133
134
135
136
137
138
139
140
141
142
143
144
145
146
147
148
149
150
151
152
153
154
155
156
157
158
159
160
161
162
163
164
165
166
167
168
169
170
171
172
173
174
175
176
177
178
179
180
181
182
183
184
185
186
187
188</pre></td><td><pre style="margin: 0; line-height: 125%">
<big><b>Computer Code (For Visualizer)</b></big>


<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">time</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">serial</span>
ser <span style="color: #333333">=</span> serial<span style="color: #333333">.</span>Serial(<span style="background-color: #fff0f0">&#39;COM6&#39;</span>, <span style="color: #0000DD; font-weight: bold">115200</span>)  <span style="color: #888888"># open serial port</span>

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">map_range</span>(<span style="color: #007020">input</span>, oriMin, oriMax, newMin, newMax):
    returnVar <span style="color: #333333">=</span> newMin<span style="color: #333333">+</span>(newMax<span style="color: #333333">-</span>newMin)<span style="color: #333333">*</span>((<span style="color: #007020">input</span><span style="color: #333333">-</span>oriMin)<span style="color: #333333">/</span>(oriMax<span style="color: #333333">-</span>oriMin))
    <span style="color: #008800; font-weight: bold">if</span> returnVar <span style="color: #333333">&gt;</span> newMax: <span style="color: #008800; font-weight: bold">return</span> newMax
    <span style="color: #008800; font-weight: bold">return</span> returnVar

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">convert</span>(percent):
    <span style="color: #008800; font-weight: bold">return</span> <span style="color: #007020">int</span>(map_range(percent, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">100</span>, <span style="color: #0000DD; font-weight: bold">51117</span>, <span style="color: #0000DD; font-weight: bold">65535</span>))

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">setLights</span>(
        frontRed,
        frontYellow,
        frontGreen,
        frontWhite,
        whiteLed,
        redLed,
        greenLed,
        rgb
    ):
    <span style="color: #008800; font-weight: bold">global</span> ser
    strSend <span style="color: #333333">=</span> f<span style="background-color: #fff0f0">&quot;{1 if frontRed else 0} {1 if frontYellow else 0} {1 if frontGreen else 0} {1 if frontWhite else 0} {whiteLed} {1 if redLed else 0} {1 if greenLed else 0} {rgb[0]} {rgb[1]} {rgb[2]}</span><span style="color: #666666; font-weight: bold; background-color: #fff0f0">\r\n</span><span style="background-color: #fff0f0">&quot;</span>
    ser<span style="color: #333333">.</span>write(<span style="color: #007020">str</span><span style="color: #333333">.</span>encode(strSend))

<span style="color: #888888"># setLights(True, True, True, True, convert(10), 1, 1, (255, 255, 0))</span>
<span style="color: #888888"># setLights(True, True, True, True, convert(0), 0, 0, (255, 255, 0))</span>
<span style="color: #888888"># setLights(True, True, True, True, convert(0), 0, 0, hsv_to_rgb(map_range(dial2.value, 0, 65535, 0, 1.0), 0.8, 0.3))</span>
<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">hsv_to_rgb</span>(h, s, v):
    <span style="color: #008800; font-weight: bold">if</span> s <span style="color: #333333">==</span> <span style="color: #6600EE; font-weight: bold">0.0</span>:
        <span style="color: #008800; font-weight: bold">return</span> v, v, v
    i <span style="color: #333333">=</span> <span style="color: #007020">int</span>(h<span style="color: #333333">*</span><span style="color: #6600EE; font-weight: bold">6.0</span>) <span style="color: #888888"># XXX assume int() truncates!</span>
    f <span style="color: #333333">=</span> (h<span style="color: #333333">*</span><span style="color: #6600EE; font-weight: bold">6.0</span>) <span style="color: #333333">-</span> i
    p <span style="color: #333333">=</span> v<span style="color: #333333">*</span>(<span style="color: #6600EE; font-weight: bold">1.0</span> <span style="color: #333333">-</span> s)
    q <span style="color: #333333">=</span> v<span style="color: #333333">*</span>(<span style="color: #6600EE; font-weight: bold">1.0</span> <span style="color: #333333">-</span> s<span style="color: #333333">*</span>f)
    t <span style="color: #333333">=</span> v<span style="color: #333333">*</span>(<span style="color: #6600EE; font-weight: bold">1.0</span> <span style="color: #333333">-</span> s<span style="color: #333333">*</span>(<span style="color: #6600EE; font-weight: bold">1.0</span><span style="color: #333333">-</span>f))
    i <span style="color: #333333">=</span> i<span style="color: #333333">%</span><span style="color: #0000DD; font-weight: bold">6</span>
    <span style="color: #008800; font-weight: bold">if</span> i <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">0</span>:
        <span style="color: #008800; font-weight: bold">return</span> v, t, p
    <span style="color: #008800; font-weight: bold">if</span> i <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">1</span>:
        <span style="color: #008800; font-weight: bold">return</span> q, v, p
    <span style="color: #008800; font-weight: bold">if</span> i <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">2</span>:
        <span style="color: #008800; font-weight: bold">return</span> p, v, t
    <span style="color: #008800; font-weight: bold">if</span> i <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">3</span>:
        <span style="color: #008800; font-weight: bold">return</span> p, q, v
    <span style="color: #008800; font-weight: bold">if</span> i <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">4</span>:
        <span style="color: #008800; font-weight: bold">return</span> t, p, v
    <span style="color: #008800; font-weight: bold">if</span> i <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">5</span>:
        <span style="color: #008800; font-weight: bold">return</span> v, p, q
    <span style="color: #888888"># Cannot get here</span>
<span style="color: #888888"># rgb = hsv_to_rgb(map_range(dial2.value, 0, 65535, 0, 1.0), 0.8, 0.3)</span>



<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">numpy.lib.function_base</span> <span style="color: #008800; font-weight: bold">import</span> disp
<span style="color: #008800; font-weight: bold">from</span> <span style="color: #0e84b5; font-weight: bold">scipy.io.wavfile</span> <span style="color: #008800; font-weight: bold">import</span> write
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">sounddevice</span> <span style="color: #008800; font-weight: bold">as</span> <span style="color: #0e84b5; font-weight: bold">REC</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">threading</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">time</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">numpy</span> <span style="color: #008800; font-weight: bold">as</span> <span style="color: #0e84b5; font-weight: bold">np</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">math</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">shutil</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">sys</span>
<span style="color: #008800; font-weight: bold">import</span> <span style="color: #0e84b5; font-weight: bold">os</span>

running <span style="color: #333333">=</span> <span style="color: #007020">True</span>
<span style="color: #888888"># Recording properties</span>
SAMPLE_RATE <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">44100</span>
SECONDS <span style="color: #333333">=</span> <span style="color: #6600EE; font-weight: bold">0.1</span>

<span style="color: #888888"># Channels</span>
MONO    <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">1</span>
STEREO  <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">2</span>

<span style="color: #888888"># Command to get all devices listed: py -m sounddevice </span>
<span style="color: #888888"># Device you want to record</span>
REC<span style="color: #333333">.</span>default<span style="color: #333333">.</span>device <span style="color: #333333">=</span> <span style="background-color: #fff0f0">&#39;PC Speaker (Realtek HD Audio output with SST), Windows WDM-KS&#39;</span>
<span style="color: #888888"># REC.default.device = REC.query_devices()[5][&#39;name&#39;]</span>

<span style="color: #888888"># print(REC.query_devices()[5])</span>

<span style="color: #008800; font-weight: bold">print</span>(f<span style="background-color: #fff0f0">&#39;Recording for {SECONDS} seconds&#39;</span>)

display <span style="color: #333333">=</span> []
toBeProcess_recordSeg <span style="color: #333333">=</span> []

samplerate <span style="color: #333333">=</span> SAMPLE_RATE
gain <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">10</span>
columns <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">80</span>
<span style="color: #888888"># columns, _ = shutil.get_terminal_size()</span>
low, high <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">100</span>, <span style="color: #0000DD; font-weight: bold">2000</span>
delta_f <span style="color: #333333">=</span> (high <span style="color: #333333">-</span> low) <span style="color: #333333">/</span> (columns <span style="color: #333333">-</span> <span style="color: #0000DD; font-weight: bold">1</span>)
fftsize <span style="color: #333333">=</span> math<span style="color: #333333">.</span>ceil(samplerate <span style="color: #333333">/</span> delta_f)
low_bin <span style="color: #333333">=</span> math<span style="color: #333333">.</span>floor(low <span style="color: #333333">/</span> delta_f)

numOfSamples <span style="color: #333333">=</span> <span style="color: #007020">int</span>(SECONDS <span style="color: #333333">*</span> SAMPLE_RATE)

lastUpdate <span style="color: #333333">=</span> time<span style="color: #333333">.</span>monotonic()
setto <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">printOut</span>():
    <span style="color: #008800; font-weight: bold">global</span> setto
    <span style="color: #008800; font-weight: bold">while</span> running:
        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #007020">len</span>(display) <span style="color: #333333">&gt;</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            <span style="color: #008800; font-weight: bold">if</span> display[<span style="color: #0000DD; font-weight: bold">0</span>] <span style="color: #333333">&gt;</span> setto:
                setto <span style="color: #333333">=</span> display[<span style="color: #0000DD; font-weight: bold">0</span>]

            volume <span style="color: #333333">=</span> map_range(display[<span style="color: #0000DD; font-weight: bold">0</span>], <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">120</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #6600EE; font-weight: bold">1.0</span>)
            hue <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">1</span> <span style="color: #333333">-</span> (volume <span style="color: #333333">+</span> <span style="color: #6600EE; font-weight: bold">0.33</span>)
            <span style="color: #008800; font-weight: bold">if</span> hue <span style="color: #333333">&gt;</span> <span style="color: #0000DD; font-weight: bold">1</span>: hue <span style="color: #333333">-=</span> <span style="color: #0000DD; font-weight: bold">1</span>
            <span style="color: #008800; font-weight: bold">if</span> hue <span style="color: #333333">&lt;</span> <span style="color: #0000DD; font-weight: bold">0</span>: hue <span style="color: #333333">+=</span> <span style="color: #0000DD; font-weight: bold">1</span>
            rgb <span style="color: #333333">=</span> hsv_to_rgb(hue, <span style="color: #0000DD; font-weight: bold">1</span>, <span style="color: #6600EE; font-weight: bold">1.0</span>)


            yellow <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            red <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            white <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>

            frontWhite <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            frontRed <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            frontYellow <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            frontGreen <span style="color: #333333">=</span> <span style="color: #007020">False</span>
            <span style="color: #008800; font-weight: bold">if</span> volume <span style="color: #333333">&gt;</span> <span style="color: #6600EE; font-weight: bold">0.5</span>:
                red <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            <span style="color: #008800; font-weight: bold">if</span> volume <span style="color: #333333">&gt;</span> <span style="color: #6600EE; font-weight: bold">0.6</span>:
                yellow <span style="color: #333333">=</span> <span style="color: #007020">True</span>

            white <span style="color: #333333">=</span> map_range(volume, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #6600EE; font-weight: bold">0.5</span>, <span style="color: #0000DD; font-weight: bold">0</span>, <span style="color: #0000DD; font-weight: bold">65535</span>)
            <span style="color: #008800; font-weight: bold">if</span> volume <span style="color: #333333">&gt;</span> <span style="color: #6600EE; font-weight: bold">0.01</span>:
                frontWhite <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            <span style="color: #008800; font-weight: bold">if</span> volume <span style="color: #333333">&gt;</span> <span style="color: #6600EE; font-weight: bold">0.04</span>:
                frontYellow <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            <span style="color: #008800; font-weight: bold">if</span> volume <span style="color: #333333">&gt;</span> <span style="color: #6600EE; font-weight: bold">0.08</span>:
                frontGreen <span style="color: #333333">=</span> <span style="color: #007020">True</span>
            <span style="color: #008800; font-weight: bold">if</span> volume <span style="color: #333333">&gt;</span> <span style="color: #6600EE; font-weight: bold">0.1</span>:
                frontRed <span style="color: #333333">=</span> <span style="color: #007020">True</span>


            setLights(frontRed, frontYellow, frontGreen, frontWhite, convert(white), red, yellow, (<span style="color: #007020">round</span>(rgb[<span style="color: #0000DD; font-weight: bold">0</span>]<span style="color: #333333">*</span><span style="color: #0000DD; font-weight: bold">256</span>), <span style="color: #007020">round</span>(rgb[<span style="color: #0000DD; font-weight: bold">1</span>]<span style="color: #333333">*</span><span style="color: #0000DD; font-weight: bold">256</span>), <span style="color: #007020">round</span>(rgb[<span style="color: #0000DD; font-weight: bold">2</span>]<span style="color: #333333">*</span><span style="color: #0000DD; font-weight: bold">256</span>)))
            setto <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">0</span>

            <span style="color: #008800; font-weight: bold">print</span>(<span style="background-color: #fff0f0">&quot;#&quot;</span><span style="color: #333333">*</span>display[<span style="color: #0000DD; font-weight: bold">0</span>] <span style="color: #333333">+</span> <span style="background-color: #fff0f0">&quot; &quot;</span> <span style="color: #333333">+</span> <span style="color: #007020">str</span>(display[<span style="color: #0000DD; font-weight: bold">0</span>])<span style="color: #333333">+</span> <span style="background-color: #fff0f0">&quot; &quot;</span> <span style="color: #333333">+</span> <span style="color: #007020">str</span>(hue))

            display<span style="color: #333333">.</span>pop(<span style="color: #0000DD; font-weight: bold">0</span>)
        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #007020">len</span>(display) <span style="color: #333333">==</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            time<span style="color: #333333">.</span>sleep(<span style="color: #6600EE; font-weight: bold">0.001</span>)
        <span style="color: #008800; font-weight: bold">else</span>:
            time<span style="color: #333333">.</span>sleep(SECONDS<span style="color: #333333">/</span><span style="color: #007020">len</span>(display))

<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">split</span>(a, n):
    k, m <span style="color: #333333">=</span> <span style="color: #007020">divmod</span>(<span style="color: #007020">len</span>(a), n)
    <span style="color: #008800; font-weight: bold">return</span> <span style="color: #007020">list</span>((a[i<span style="color: #333333">*</span>k<span style="color: #333333">+</span><span style="color: #007020">min</span>(i, m):(i<span style="color: #333333">+</span><span style="color: #0000DD; font-weight: bold">1</span>)<span style="color: #333333">*</span>k<span style="color: #333333">+</span><span style="color: #007020">min</span>(i<span style="color: #333333">+</span><span style="color: #0000DD; font-weight: bold">1</span>, m)] <span style="color: #008800; font-weight: bold">for</span> i <span style="color: #000000; font-weight: bold">in</span> <span style="color: #007020">range</span>(n)))


<span style="color: #008800; font-weight: bold">def</span> <span style="color: #0066BB; font-weight: bold">processBuffer</span>():
    <span style="color: #008800; font-weight: bold">while</span> running:
        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #007020">len</span>(toBeProcess_recordSeg) <span style="color: #333333">&gt;</span> <span style="color: #0000DD; font-weight: bold">0</span>:
            recordSeg <span style="color: #333333">=</span> toBeProcess_recordSeg[<span style="color: #0000DD; font-weight: bold">0</span>]
            recordingSplit <span style="color: #333333">=</span> split(recordSeg, <span style="color: #007020">int</span>(SECONDS<span style="color: #333333">/</span><span style="color: #6600EE; font-weight: bold">0.009</span>))
            <span style="color: #888888"># print(len(recordingSplit))</span>
            <span style="color: #008800; font-weight: bold">for</span> recording <span style="color: #000000; font-weight: bold">in</span> recordingSplit:
                magnitude <span style="color: #333333">=</span> np<span style="color: #333333">.</span>abs(np<span style="color: #333333">.</span>fft<span style="color: #333333">.</span>rfft(recording[:, <span style="color: #0000DD; font-weight: bold">0</span>], n<span style="color: #333333">=</span>fftsize))
                magnitude <span style="color: #333333">*=</span> gain <span style="color: #333333">/</span> fftsize
                scaled <span style="color: #333333">=</span> <span style="color: #007020">pow</span>((np<span style="color: #333333">.</span>average(magnitude)<span style="color: #333333">*</span><span style="color: #0000DD; font-weight: bold">10000</span>)<span style="color: #333333">/</span><span style="color: #0000DD; font-weight: bold">2</span>, <span style="color: #0000DD; font-weight: bold">2</span>)<span style="color: #333333">*</span><span style="color: #6600EE; font-weight: bold">0.01</span>
                <span style="color: #008800; font-weight: bold">if</span> scaled <span style="color: #333333">&gt;</span> <span style="color: #0000DD; font-weight: bold">10</span>: scaled <span style="color: #333333">=</span> <span style="color: #0000DD; font-weight: bold">50</span><span style="color: #333333">*</span>math<span style="color: #333333">.</span>log(scaled, <span style="color: #0000DD; font-weight: bold">10</span>)
                scaled <span style="color: #333333">=</span> <span style="color: #007020">int</span>(scaled)
                display<span style="color: #333333">.</span>append(<span style="color: #0000DD; font-weight: bold">120</span> <span style="color: #008800; font-weight: bold">if</span> scaled <span style="color: #333333">&gt;</span> <span style="color: #0000DD; font-weight: bold">120</span> <span style="color: #008800; font-weight: bold">else</span> scaled)
            toBeProcess_recordSeg<span style="color: #333333">.</span>pop(<span style="color: #0000DD; font-weight: bold">0</span>)
        time<span style="color: #333333">.</span>sleep(SECONDS<span style="color: #333333">/</span><span style="color: #0000DD; font-weight: bold">10</span>)

threading<span style="color: #333333">.</span>Thread(target<span style="color: #333333">=</span>processBuffer)<span style="color: #333333">.</span>start()
threading<span style="color: #333333">.</span>Thread(target<span style="color: #333333">=</span>printOut)<span style="color: #333333">.</span>start()

<span style="color: #008800; font-weight: bold">try</span>:
    <span style="color: #008800; font-weight: bold">while</span> <span style="color: #007020">True</span>:
        <span style="color: #888888"># Starts recording</span>
        recordSeg <span style="color: #333333">=</span> REC<span style="color: #333333">.</span>rec(numOfSamples, samplerate <span style="color: #333333">=</span> SAMPLE_RATE, channels <span style="color: #333333">=</span> MONO)
        REC<span style="color: #333333">.</span>wait()  <span style="color: #888888"># Waits for recording to finish</span>
        <span style="color: #008800; font-weight: bold">if</span> <span style="color: #007020">any</span>(recordSeg):
            toBeProcess_recordSeg<span style="color: #333333">.</span>append(recordSeg)
            <span style="color: #888888"># print(toBeProcess_recordSeg[0])</span>

<span style="color: #008800; font-weight: bold">except</span> <span style="color: #FF0000; font-weight: bold">KeyboardInterrupt</span>:
    running <span style="color: #333333">=</span> <span style="color: #007020">False</span>
    os<span style="color: #333333">.</span>_exit(<span style="color: #0000DD; font-weight: bold">0</span>)
    
    
</pre></td></tr></table></div>

    </div>

    

</body>
</html>