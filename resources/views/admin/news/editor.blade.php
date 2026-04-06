@extends('admin_layout')

@section('css')
<style>
		.sidebar-link { color: rgb(71 85 105); }
		.sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
		.sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
		.ck-editor__editable { min-height: 500px !important; }
		.ck.ck-editor { max-width: 100%; }
		.ck-content { padding-left: 25px; }
	</style>
@endsection

@section('content')
    <section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm flex flex-wrap items-center justify-between gap-3">
					<div>
						<h2 id="editorHeading" class="text-base font-semibold text-slate-900">Tạo bài viết</h2>
						<p class="mt-1 text-sm text-slate-500">Nhập đầy đủ thông tin bài viết và nội dung rich text bằng CKEditor.</p>
					</div>
					<a href="{{ route('admin.news') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Quay lại danh sách</a>
				</section>

				<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					<form id="newsForm" class="grid gap-4 md:grid-cols-2">
						<div class="rounded-xl border border-slate-100 p-4">
							<label class="mb-1 block text-sm font-medium text-slate-700">ID</label>
							<input id="fieldId" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm" value="(auto)" readonly />
						</div>
						<div class="rounded-xl border border-slate-100 p-4">
							<label class="mb-1 block text-sm font-medium text-slate-700">Slug</label>
							<input id="fieldSlug" name="slug" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" placeholder="khuyen-mai-thang-3" />
						</div>

						<div class="rounded-xl border border-slate-100 p-4 md:col-span-2">
							<label class="mb-1 block text-sm font-medium text-slate-700">Title</label>
							<input id="fieldTitle" name="title" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" placeholder="Tiêu đề bài viết" />
						</div>

						<div class="rounded-xl border border-slate-100 p-4 md:col-span-2">
							<label class="mb-1 block text-sm font-medium text-slate-700">Excerpt</label>
							<textarea id="fieldExcerpt" name="excerpt" rows="3" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" placeholder="Tóm tắt ngắn (max ~255 ký tự)"></textarea>
						</div>

						<div class="rounded-xl border border-slate-100 p-4 md:col-span-2">
							<label class="mb-1 block text-sm font-medium text-slate-700">Featured image URL</label>
							<input id="fieldImage" name="featured_image" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" placeholder="https://example.com/news.jpg" />
						</div>

						<div class="rounded-xl border border-slate-100 p-4 md:col-span-2">
							<label class="mb-1 block text-sm font-medium text-slate-700">Content (CKEditor)</label>
							<textarea id="fieldContent" name="content" rows="20" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" placeholder="Nội dung bài viết... (sau này thay bằng editor)"></textarea>
						</div>

						<div class="rounded-xl border border-slate-100 p-4">
							<label class="mb-1 block text-sm font-medium text-slate-700">Trạng thái xuất bản (is_published)</label>
							<select id="fieldPublished" name="is_published" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm">
								<option value="0">0 - Nháp</option>
								<option value="1">1 - Đã đăng</option>
							</select>
						</div>
						<div class="rounded-xl border border-slate-100 p-4">
							<label class="mb-1 block text-sm font-medium text-slate-700">published_at</label>
							<input id="fieldPublishedAt" type="datetime-local" name="published_at" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" />
						</div>

						<div class="rounded-xl border border-slate-100 p-4">
							<label class="mb-1 block text-sm font-medium text-slate-700">created_at</label>
							<input id="fieldCreatedAt" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm" readonly />
						</div>
						<div class="rounded-xl border border-slate-100 p-4">
							<label class="mb-1 block text-sm font-medium text-slate-700">updated_at</label>
							<input id="fieldUpdatedAt" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm" readonly />
						</div>

						<div class="md:col-span-2 flex justify-end gap-2 pt-2">
							<a href="{{ route('admin.news') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Hủy</a>
							<button id="submitButton" type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Lưu bài viết</button>
						</div>
					</form>
				</section>

@endsection

@section('script')
	<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
	<script>
		// const sidebar = document.getElementById('sidebar');
		// const overlay = document.getElementById('overlay');
		// const menuButton = document.getElementById('menuButton');
		// menuButton.addEventListener('click', () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); });
		// overlay.addEventListener('click', () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); });

		const editorHeading = document.getElementById('editorHeading');
		const formElement = document.getElementById('newsForm');
		const submitButton = document.getElementById('submitButton');
		const params = new URLSearchParams(window.location.search);
		const newsId = params.get('id');
		const csrfToken = '{{ csrf_token() }}';
		const indexUrl = '{{ route('admin.news') }}';
		const storeUrl = '{{ route('admin.news.store') }}';
		const detailUrlTemplate = '{{ route('admin.news.show', ['id' => '__ID__']) }}';
		const updateUrlTemplate = '{{ route('admin.news.update', ['id' => '__ID__']) }}';

		const fieldId = document.getElementById('fieldId');
		const fieldTitle = document.getElementById('fieldTitle');
		const fieldSlug = document.getElementById('fieldSlug');
		const fieldContent = document.getElementById('fieldContent');
		const fieldImage = document.getElementById('fieldImage');
		const fieldExcerpt = document.getElementById('fieldExcerpt');
		const fieldPublished = document.getElementById('fieldPublished');
		const fieldPublishedAt = document.getElementById('fieldPublishedAt');
		const fieldCreatedAt = document.getElementById('fieldCreatedAt');
		const fieldUpdatedAt = document.getElementById('fieldUpdatedAt');
		let ckEditorInstance = null;

		const setSubmittingState = (isSubmitting) => {
			submitButton.disabled = isSubmitting;
			submitButton.classList.toggle('opacity-70', isSubmitting);
			submitButton.textContent = isSubmitting ? 'Đang lưu...' : 'Lưu bài viết';
		};

		const loadInitialState = () => {
			if (newsId) {
				editorHeading.textContent = 'Cập nhật bài viết';
				return;
			}

			editorHeading.textContent = 'Tạo bài viết';
			fieldId.value = '(auto)';
			fieldCreatedAt.value = '(sẽ tự động tạo khi lưu)';
			fieldUpdatedAt.value = '(sẽ tự động cập nhật khi lưu)';
		};

		const populateForm = (newsData) => {
			fieldId.value = newsData.id;
			fieldTitle.value = newsData.title || '';
			fieldSlug.value = newsData.slug || '';
			fieldImage.value = newsData.featured_image || '';
			fieldExcerpt.value = newsData.excerpt || '';
			fieldPublished.value = String(newsData.is_published ?? 0);
			fieldPublishedAt.value = newsData.published_at || '';
			fieldCreatedAt.value = newsData.created_at || '';
			fieldUpdatedAt.value = newsData.updated_at || '';

			if (ckEditorInstance) {
				ckEditorInstance.setData(newsData.content || '');
			} else {
				fieldContent.value = newsData.content || '';
			}
		};

		const fetchNewsDetail = async () => {
			if (!newsId) {
				return;
			}

			try {
				const response = await fetch(detailUrlTemplate.replace('__ID__', newsId), {
					headers: {
						'Accept': 'application/json'
					}
				});

				if (!response.ok) {
					const errorPayload = await response.json().catch(() => ({}));
					throw new Error(errorPayload.message || 'Không thể tải dữ liệu bài viết');
				}

				const newsData = await response.json();
				populateForm(newsData);
			} catch (error) {
				window.alert(error.message || 'Có lỗi khi tải bài viết');
				window.location.href = indexUrl;
			}
		};

		const initCkEditor = async () => {
			if (typeof ClassicEditor === 'undefined') {
				throw new Error('Không tải được CKEditor từ CDN. Vui lòng kiểm tra Internet hoặc tắt extension chặn script.');
			}

			ckEditorInstance = await ClassicEditor.create(fieldContent, {
				toolbar: [
					'heading', '|',
					'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
					'blockQuote', 'insertTable', 'undo', 'redo'
				]
			});
		};

		formElement.addEventListener('submit', (event) => {
			event.preventDefault();

			const submitForm = async () => {
				setSubmittingState(true);

				const payload = {
					title: fieldTitle.value.trim(),
					slug: fieldSlug.value.trim(),
					content: ckEditorInstance ? ckEditorInstance.getData() : fieldContent.value,
					featured_image: fieldImage.value.trim(),
					excerpt: fieldExcerpt.value.trim(),
					is_published: Number(fieldPublished.value || 0),
					published_at: fieldPublishedAt.value || null,
				};

				const targetUrl = newsId ? updateUrlTemplate.replace('__ID__', newsId) : storeUrl;
				const method = newsId ? 'PUT' : 'POST';

				try {
					const response = await fetch(targetUrl, {
						method,
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json',
							'X-CSRF-TOKEN': csrfToken
						},
						body: JSON.stringify(payload)
					});

					if (!response.ok) {
						const errorPayload = await response.json().catch(() => ({}));
						if (errorPayload.errors) {
							const firstError = Object.values(errorPayload.errors)[0];
							throw new Error(Array.isArray(firstError) ? firstError[0] : 'Dữ liệu không hợp lệ');
						}

						throw new Error(errorPayload.message || 'Không thể lưu bài viết');
					}

					window.alert(newsId ? 'Cập nhật bài viết thành công' : 'Tạo bài viết thành công');
					window.location.href = indexUrl;
				} catch (error) {
					window.alert(error.message || 'Có lỗi xảy ra khi lưu bài viết');
				} finally {
					setSubmittingState(false);
				}
			};

			submitForm();
		});

		const initPage = async () => {
			try {
				loadInitialState();
				await initCkEditor();
				await fetchNewsDetail();
			} catch (error) {
				window.alert(error.message || 'Không thể khởi tạo trình soạn thảo CKEditor');
			}
		};

		initPage();
	</script>
@endsection
