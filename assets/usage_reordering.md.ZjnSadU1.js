import{_ as i,c as s,o as a,ag as t}from"./chunks/framework.Bv698wUK.js";const g=JSON.parse('{"title":"Reordering","description":"","frontmatter":{},"headers":[],"relativePath":"usage/reordering.md","filePath":"usage/reordering.md"}'),n={name:"usage/reordering.md"};function r(o,e,d,l,p,h){return a(),s("div",null,e[0]||(e[0]=[t('<h1 id="reordering" tabindex="-1">Reordering <a class="header-anchor" href="#reordering" aria-label="Permalink to &quot;Reordering&quot;">​</a></h1><p>Reordering records in the table can be implemented if your model has an order column to save its position.</p><div class="info custom-block"><p class="custom-block-title">INFO</p><p>If you have enabled reordering and no sorting is set by the user, the table will automatically sort its records using the order column. You don&#39;t need an additional column for this.</p></div><p>By default, reordering records is disabled. It can be enabled by adding the following property to your class:</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">protected</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> bool</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $useReordering </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> true</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span></code></pre></div><p>It will use the column with the name of <code>order</code> by default but it can be overwitten like so:</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">protected</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> string</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $reorderingColumn </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;position&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span></code></pre></div><p>If the reordering functionality has been enabled, a new button will show up. When reordering, the button will be activated and the rows in the table can be dragged and dropped.</p>',8)]))}const k=i(n,[["render",r]]);export{g as __pageData,k as default};
